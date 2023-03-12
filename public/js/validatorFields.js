function UTNumeric(evt){
    //asignamos el valor de la tecla a keynum
    if(window.event){// IE
        keynum = evt.keyCode;
    }else{
        keynum = evt.which;
    }
    //comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
    if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6 ){
        return true;
    }
    else{
        return false;
    }
}

function UTZero(event,field){
    var str = field.value;
    if(str.length==0){
        field.value="0";
        field.setSelectionRange(0,1);
    }
}

function UTFloat(e, field) {
    key = e.keyCode ? e.keyCode : e.which
    // backspace
    if ((key == 8)|| (key == 37)|| (key == 39)) return true
    if ((key == 13) || (key == 9)) return true;//13 enter 9 tab
    // 0-9
    if (key > 47 && key < 58) {
        if (field.value == "") return true
        regexp =  /[0-9][0-9][0-9][0-9].[0-9]{2}$/
        return !(regexp.test(field.value))
    }
    // .
    if (key == 46) {
        if (field.value == "") return false
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    } // other key
    return false
}

function UTText(e){
    var key = window.Event ? e.which : e.keyCode
    if ((key == 13) || (key == 9) || (key == 8))return true;
    return (key == 32 /* espacio */
        || key == 33 /* ! */
        || key == 35 /* # */
        || key == 36 /* $ */
        || key == 37 /* % */
        || key == 38 /* & */
        || key == 40 /* ( */
        || key == 41 /* ) */
        || key == 42 /* * */
        || key == 43 /* + */
        || key == 44 /* , */
        || key == 45 /* - */
        || key == 46 /* . */
        || key == 47 /* / */
        || (key >= 48 && key <= 57) /* 0-9 */
        || key == 58 /* : */
        || key == 59 /* ; */
        || key == 60 /* < */
        || key == 61 /* = */
        || key == 62 /* > */
        || key == 63 /* ? */
        || key == 64 /* @ */
        || (key >= 65 && key <= 90) /* A-Z */
        || key == 95 /* _ */
        || (key >= 97 && key <= 122) /* a-z */
        || key == 161 /* ¡ */
        || key == 191 /* ¿ */
        || key == 193 /* Á */
        || key == 201 /* É */
        || key == 205 /* Í */
        || key == 211 /* Ó */
        || key == 218 /* Ú */
        || key == 225 /* á */
        || key == 233 /* é */
        || key == 237 /* í */
        || key == 243 /* ó */
        || key == 250 /* ú */
        || key == 209 /* Ñ */
        || key == 241 /* ñ */);
}

function soloNumeros(evt){
    if (window.event) { //asignamos el valor de la tecla a keynum
        keynum = evt.keyCode; //IE
    } else {
        keynum = evt.which; //FF
    }
    //comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
    if ((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6 ) {
        return true;
    } else {
        return false;
    }
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}

function Letras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46-32";

    tecla_especial = false
    for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}