<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class Categorycontroller extends Controller
{

    public function index(Request $request)
    {
        $search = "";
        $limit = 10;
        if ($request->has('search')) {
            $search = $request->input('search');

            if (trim($search) != '') {
                $data = Category::where('nombre', 'like', "%$search%");
                    
            } else {
                $data = Category::all();
            }
        } else {
            $data = Category::all();
        }
        $currentPage = Paginator::resolveCurrentPage() - 1;
        $perPage = $limit;
        $currentPageSearchResults = $data->slice($currentPage * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($data), $perPage);
        return view('admin.categorias.index', ['data' => $data, 'search' => $search, 'page' => $currentPage]);
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            // DB::beginTransaction();
            // dd($request);

            DB::beginTransaction();
            $validated = $request->validate([
                'nombre' => ['required', 'string', 'max:40'],
                'descripcion' => ['required', 'string', 'max:255',],
            ]);

            //dd($request);

            Category::create([
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
            ]);



            DB::commit();
            Session::flash('status', "Se ha agregado correctamente el registro");
            Session::flash('status_type', 'success');
            return redirect(route('category.index'));
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
        $category = Category::findOrFail($id);
        return view('admin.categorias.delete', ['category' => $category]);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $category->delete();
            DB::commit();
            Session::flash('status', "Se ha eliminado correctamente el registro");
            Session::flash('status_type', 'success');
            return redirect(route('category.index'));
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

    public function update(Request $request, $id)
    {
        
        // try {
        //     DB::beginTransaction();

        //     /*$validated = $request->validate([
        //         'nombre' => ['required', 'string', 'max:100'],
        //         'password' => ['required', 'string', 'min:8'],
        //     ]);*/

        //     $valida = Category::where('nombre', '=', $request['nombre'])->first();
        //     if ($valida != null && $valida->id == $id) {
        //         if ($request['nombre'] != null) {
        //             $data = [
        //                 'nombre' => $request['nombre'],
        //                 'descripcion' => $request['descripcion'],
        //             ];
        //         } else {
        //             $data = [
        //                 'nombre' => $request['nombre'],
        //             ];
        //         }
        //     }  else {
        //         Session::flash('status', "Categoria ya asignada");
        //         Session::flash('status_type', 'warning');
        //         return back();
        //     }
        //     $category = Category::findOrFail($id);
        //     $category->update($data);
        //     DB::commit();
        //     Session::flash('status', "Se ha editado correctamente el registro");
        //     Session::flash('status_type', 'success');
        //     return redirect(route('users.index'));
        // } catch (\Illuminate\Database\QueryException $ex) {
        //     DB::rollBack();
        //     Session::flash('status', $ex->getMessage());
        //     Session::flash('status_type', 'error-Query');
        //     return back();
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Session::flash('status', $e->getMessage());
        //     Session::flash('status_type', 'error');
        //     return back();
        // }
        try {
            DB::beginTransaction();
            
            $data = [
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
            ];
            $category = Category::findOrFail($id);
            $category->update($data);
            DB::commit();
            Session::flash('status', "Se ha editado correctamente el registro");
            Session::flash('status_type', 'success');
            return redirect(route('category.index'));
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

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        // dd($user);
        return view('admin.categorias.edit', ['category' => $category]);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categorias.show', ['category' => $category]);
    }

}
