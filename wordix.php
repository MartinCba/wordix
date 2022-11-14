<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 *  Función 1
 *  Se le pide al usuario que ingrese un numero y se realiza una validacion si se encuentra entre el minimo y el maximo permitido.
 *  @param int $min
 *  @param int $max
 *  @return int $numero
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/**
 * Función 2
 * Recibe una variable de tipo string y la imprime por pantalla en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Función 3
 * Recibe una variable de tipo string y la imprime por pantalla en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Función 4
 * Recibe una variable de tipo string y la imprime por pantalla en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Función 5
 * Recibe una variable de tipo string y la imprime por pantalla en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Función 6
 * Recibe una variable de tipo string y la imprime por pantalla
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Función 7
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**
 * Función 8
 * Esta Función recibe un nombre de usuario y lo utiliza para enviar una bienvenida personalizada por pantalla
 * @param string $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}


/**
 * Función 9
 * Este modulo recibe un string e indica si está compuesto en su totalidad por letras o no
 * @param string $cadena
 * @return boolean
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/**
 * Función 10
 * Este modulo le pide al usuario que ingrese una palabra de 5 letras y se encarga de verificarlo
 * mientras no se cumpla la condición se volverá a pedir ingresar una palabra
 * Cuando se verifique una palabra ingresada correctamente la retornara
 * @return string
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra);

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) {
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}


/**
 * Función 11
 * Inicia una estructura de datos Teclado. La estructura es de tipo: asociativo.
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Función 12
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Función 13
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estructuraIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    $cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados; //Estaba comentado

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra! \n"; //Estaba comentado
    echo "";
}

/**
 * Función 14
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento); //guarda la cantidad de caracteres que tiene la palabra (innecesario)
    $estructuraPalabraIntento = []; //almacena cada letra de la palabra intento con su estado
    for ($i = 0; $i < $cantCaracteres; $i++) { //itera siempre 5 veces
        $letraIntento = $palabraIntento[$i]; //guarda en $letraIntento la letra en la posicion $i de la palabra
        $posicion = strpos($palabraWordix, $letraIntento); //indica si la letra leída del intento existe en la palabra correcta
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA; //si la palabra no existe se indicará como descartada
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA; //si existe y coinciden las posiciones se indica como encontrada
            } else {
                $estado = ESTADO_LETRA_PERTENECE; //si existe pero no coinciden las posiciones se indica como pertenece
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
        /* se guarda en el arreglo creado anteriormente $estucturaPalabraIntento
        otro arreglo de indices asociativos que guarda la letra y el estado que le corresponde a cada una
        de ellas
        */
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    /* guarda en la ultima posicion de $estructuraIntentosWordix el arreglo que contiene el estado de
    todas las letras del intento que hizo el usuario
    */
    return $estruturaIntentosWordix;
    /* Retorna el mismo arreglo que recibio pero le agrega el arreglo que contiene el estado de las letras
    de la ultima palabra probada por el usuario
    */
}

/**
 * Función 15
 * Actualiza el estado de las letras del teclado.
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA,
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA,
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Función 16
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return boolean
 */
function esIntentoGanado($estructuraPalabraIntento)
{
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * Función 17
 * Este modulo recibe una palabra y un número de intento con los cuales determina un puntaje
 * @param int $nroIntento
 * @param string $palabraWordix
 * @return int $puntajeFinal
 */
function obtenerPuntajeWordix($nroIntento, $palabraWordix)
{
    switch ($nroIntento) {
        case 1:
            $puntajeFinal = 6;
            break;
        case 2:
            $puntajeFinal = 5;
            break;
        case 3:
            $puntajeFinal = 4;
            break;
        case 4:
            $puntajeFinal = 3;
            break;
        case 5:
            $puntajeFinal = 2;
            break;
        case 6:
            $puntajeFinal = 1;
            break;
        default:
            $puntajeFinal = 0;
            break;
    }

    for ($i = 0; $i < strlen($palabraWordix); $i++) {
        $letra = strToLower($palabraWordix[$i]);
        if ($letra == "a" || $letra == "e" || $letra == "i" || $letra == "o" || $letra == "u") {
            $puntajeFinal = $puntajeFinal + 1;
        } elseif ($letra == "b" || $letra == "c" || $letra == "d" || $letra == "f" || $letra == "g" || $letra == "h" || $letra == "j" || $letra == "k" || $letra == "l" || $letra == "m") {
            $puntajeFinal = $puntajeFinal + 2;
        } else {
            $puntajeFinal = $puntajeFinal + 3;
        }
    }
    return $puntajeFinal;
}

/**
 * Función 18
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = []; //se crea un arreglo de intentos
    $teclado = iniciarTeclado(); //se crea un arreglo que contiene el estado de cada tecla del teclado
    escribirMensajeBienvenida($nombreUsuario); //mensaje personalizado
    $nroIntento = 1; // se inicializa el primer intento
    do { //esta repetitiva corresponde al momento en que se está jugando repite HASTA 6 veces

        echo "Comenzar con el Intento " . $nroIntento . ":\n"; //indica al usuario numero de intentos
        $palabraIntento = leerPalabra5Letras(); //se le asigna la palabra que ingrese el usuario que esta jugando
        $indiceIntento = $nroIntento - 1; // empieza en 0, sirve para recorrer el arreglo $arregloDeIntentosWordix
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        /* arreglo de intentos vale otro arreglo retornado al que se le agrega un arreglo al final
        que contiene el estado de la palabra ingresada
        */
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        // actualiza el estado de las teclas del teclado y se guarda en $teclado
        //Mostrar los resultados del análisis:
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        //Determinar si la plabra intento ganó e incrementar la cantidad de intentos

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        //el modulo verifica si la palabra que se intento gano o no
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix($nroIntento, $palabraWordix);
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos! \n";
    } else {
        $nroIntento = 0; //resetea intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}
