<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = "";
        $limit = 10;
        if ($request->has('search')) {
            $search = $request->input('search');
            if (trim($search) != '') {
                $data = Product::where('nombre', 'like', "%$search%")->get();
            } else {
                $data = Product::all();
            }
        } else {
            $data = Product::all();
        }
        $currentPage = Paginator::resolveCurrentPage() - 1;
        $perPage = $limit;
        $currentPageSearchResults = $data->slice($currentPage * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($data), $perPage);

        return view('admin.productos.index', ['data' => $data, 'search' => $search, 'page' => $currentPage]);
    }

    public function create()
    {
        $product = new Product();
        $cat = Category::pluck('nombre', 'id');
        $prov = Manufacturer::pluck('nombre', 'id');

        return view('admin.productos.create', compact('product', 'cat', 'prov'));
    }

    public function store(Request $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();

            $namefile = $request['nombre'] . '_';
            $ext_file = array('jpg', 'png', 'jpeg');


            //acá abajo se especifica en dónde se van a guardar las imagenes
            $value = $this->loadimage($request, 'img', $ext_file, 1000, 1000, 2000000, $namefile, 'imagenes/productos');
            if ($value === 'tamano' || $value === 'formato' || $value === 'existencia' || $value === 'dimension') {
                Session::flash('status', 'La imagen del producto no pudo ser guardada, ya que representa un problema de :) ' . $value);
                Session::flash('status_type', 'warning');
                return back()->withInput();
            }

            $dataproducto = [

                'categoria_id' => $request['categoria'],
                'fabricante_id' => $request['fabricante'],
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'precio_u' => $request['precio_u'],
                'precio_m' => $request['precio_m'],
                'cantidad_m' => $request['cantidad_m'],
                'img' => $value,

            ];
            $producto = new Product($dataproducto);
            $producto->save();


            DB::commit();
            Session::flash('status', "Se ha agregado correctamente el registro");
            Session::flash('status_type', 'success');
            return redirect(route('product.index'));

        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            Session::flash('status', $ex->getMessage());
            Session::flash('status_type', 'error-Query');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('status', $e->getMessage());
            Session::flash('status_type', 'error');
            return back();
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.productos.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $cat = Category::pluck('nombre', 'id');
        $prov = Manufacturer::pluck('nombre', 'id');
        $product = Product::findOrFail($id);
        return view('admin.productos.edit', ['product' => $product],compact('product', 'cat', 'prov'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

          try {
            DB::beginTransaction();
            //dd($request);
            if ($request->file('img') != null) {
                $namefile = $request['nombre'] . '_';
                $ext_file = array('jpg', 'png', 'jpeg');

                $value = $this->loadimage($request, 'img', $ext_file, 800, 800, 2000000, $namefile, 'imagenes/productos');
                if ($value === 'tamano' || $value === 'formato' || $value === 'existencia' || $value === 'dimension') {
                    Session::flash('status', 'La imagen del producto no pudo ser guardada ya que representa un problema de ' . $value);
                    Session::flash('status_type', 'warning');
                    return back()->withInput();
                }

                $dataproducto = [
                    'id' =>$request['id'],
                    'categoria_id' => $product['categoria_id'],
                    'fabricante_id' => $product['fabricante_id'],
                    'nombre' => $request['nombre'],
                    'descripcion' => $request['descripcion'],
                    'precio_u' => $request['precio_u'],
                    'precio_m' => $request['precio_m'],
                    'cantidad_m' => $request['cantidad_m'],
                    'img' => $value,

                ];
                $newproduct = Product::findOrFail($id);
                $newproduct->update($dataproducto);
            } else {
                $dataproducto = [
                    'id' =>$request['id'],
                    'categoria_id' => $product['categoria_id'],
                    'fabricante_id' => $product['fabricante_id'],
                    'nombre' => $request['nombre'],
                    'descripcion' => $request['descripcion'],
                    'precio_u' => $request['precio_u'],
                    'precio_m' => $request['precio_m'],
                    'cantidad_m' => $request['cantidad_m'],


                ];
                $newproduct = Product::findOrFail($id);
                $newproduct->update($dataproducto);
            }
            DB::commit();
            Session::flash('status', "Se ha editado correctamente el registro :-)");
            Session::flash('status_type', 'success');
            return redirect(route('product.index'));

        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            Session::flash('status', $ex->getMessage());
            Session::flash('status_type', 'error-Query');
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('status', $e->getMessage());
            Session::flash('status_type', 'error');
            return back();
        }

    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.productos.delete', ['product' => $product]);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $product->delete();

            DB::commit();
            Session::flash('status', "Se ha eliminado correctamente el registro");
            Session::flash('status_type', 'success');
            return redirect(route('product.index'));

        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            Session::flash('status', $ex->getMessage());
            Session::flash('status_type', 'error-Query');
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('status', $e->getMessage());
            Session::flash('status_type', 'error');
            return back();
        }
    }

    function loadimage($request, $nameimg, $mimearray, $min, $max, $maxweight, $nameimage, $urlimage)
    {
        if ($request->file($nameimg) != null) {
            $extension = strtolower($request->file($nameimg)->getClientOriginalExtension());
            if (in_array($extension, $mimearray)) {
                $size = getimagesize($request->file($nameimg));
                if ($size[0] <= $min && $size[1] <= $max) {
                    $weight = $_FILES[$nameimg]['size'];
                    if ($weight < $maxweight) {
                        //guardamos la imagen
                        $name = $nameimage . date("d") . date("H") . date("i") . date("s") . '.' . $extension;
                        $path = public_path($urlimage);//obtenemos la ruta del archivo
                        $request->file($nameimg)->move($path, $name);
                        $value = $name;
                        return $value;
                    } else {
                        return 'tamano';
                    }
                } else {
                    return 'dimension';
                }
            } else {
                return 'formato';
            }
        } else {
            return 'existencia';
        }

    }
}
