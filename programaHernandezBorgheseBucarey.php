<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/


/* Hernandez Martín - FAI-4433 - TUDW - martinalejandrohernandez1@gmail.com - MartinCba  */
/* Bucarey Mateo - FAI-4319 - TUDW - mateobucarey017@gmail.com - mateobucarey */
/* Borghese Nicolás - FAI-997 - TUDW - nicolasborghese@hotmail.com - NicolasBorghese */



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "NARIZ", "TIGRE", "BICIS", "LIMON", "FRENO",
        "MONOS", "ARBOL", "GORRO", "NORTE", "RATON",
    ];

    return ($coleccionPalabras);
}

/**
 * Se obtiene los datos de la partida con una palabra elegida
 * @return array
 */
function palabraElegida(){
    //int $antePalabra, $palabra, $i, $numPalabra,  string $nombre, $respuesta, array $coleccionElegida, $datosPartidas

    $antePalabra = 0;
    $palabra = 0;
    $i = 0;
    do {
        echo "Ingrese su nombre: ";
        $nombre = trim(fgets(STDIN));
        do {
            echo "Ingrese el número de palabra para jugar: ";
            $numPalabra = trim(fgets(STDIN));
            if ($antePalabra == $numPalabra) {
                echo "¡Debe ingresar otro numero de palabra!";
            }
        } while ($antePalabra == $numPalabra);
        $antePalabra = $numPalabra;
        $palabra = cargarColeccionPalabras();
        $palabra = $palabra[$numPalabra];
        $coleccionElegida[$i] = jugarWordix($palabra, $nombre);
        $i = $i + 1;
        echo "¿Desea seguir jugando? (s/n) ";
        $respuesta = trim(fgets(STDIN));
    } while ($respuesta == "s" || $respuesta == "S");
    $datosPartidas  = cargarPartidas($coleccionElegida);
    return $datosPartidas;
}

/**
 * Se obtiene los datos de la partida con una palabra aleatoria
 * @return array
 */
function palabraAleatoria(){
    //int $i, string $nombre, $palabra, $respuesta,  array $coleccionPalabra, $coleccionAleatoria, $datosPartidas

    $i = 0;
    $coleccionPalabra = cargarColeccionPalabras();
    shuffle($coleccionPalabra);
    do {
    echo "Ingrese su nombre: ";
    $nombre = trim(fgets(STDIN));
    $palabra = $coleccionPalabra[$i];
    $colecionAleatoria[$i] = jugarWordix($palabra, $nombre);
    $i = $i + 1;
    echo "¿Desea seguir jugando? (s/n) ";
    $respuesta = trim(fgets(STDIN));
    } while ($respuesta == "s" || $respuesta == "S");
    $datosPartidas  = cargarPartidas($colecionAleatoria);
    return $datosPartidas;
}

/**
 * Muestra los datos de una partida
 */
function mostrarPartida(){
    $error = false;
    $partidas = cargarPartidas();

    do {
    echo "Ingrese un numero de partida: ";
    $numeroPartida = trim(fgets(STDIN));
    if ($numeroPartida > 10) {
        echo "¡ERROR! ¡El numero de partida no existe!";
        $error = true;
    }
    } while ($error);

    $partida = $partidas[$numeroPartida];
    echo "Partida WORDIX ".$numeroPartida.": palabra ".$partida["palabraWordix"] ."\n";
    echo "Jugador: ".$partida["jugador"]."\n";
    echo "Puntaje: ".$partida["puntaje"]."\n";
    echo "Intento: ";
    if ($partida["intentos"] != 0){
        echo "Adivino la palabra en ".$partida["intentos"]. " intentos \n" ;
    } else {
        echo "No adivino la palabra \n";
    }
}

/**
 * Obtiene una colección de partidas
 * @return $coleccionPartidas
 */
function cargarPartidas()
{
    $coleccionPartidas = [];
    $coleccionPartidas[0] = ["palabraWordix" => "QUESO", "jugador" => "juan", "intentos" => 5, "puntaje" => 10];
    $coleccionPartidas[1] = ["palabraWordix" => "CASAS", "jugador" => "pedro", "intentos" => 3, "puntaje" => 14];
    $coleccionPartidas[2] = ["palabraWordix" => "QUESO", "jugador" => "maria", "intentos" => 6, "puntaje" => 12];
    $coleccionPartidas[3] = ["palabraWordix" => "LIMON", "jugador" => "ana", "intentos" => 2, "puntaje" => 14];
    $coleccionPartidas[4] = ["palabraWordix" => "FUEGO", "jugador" => "juan", "intentos" => 4, "puntaje" => 12];
    $coleccionPartidas[5] = ["palabraWordix" => "HUEVO", "jugador" => "fer", "intentos" => 1, "puntaje" => 16];
    $coleccionPartidas[6] = ["palabraWordix" => "ARBOL", "jugador" => "juan", "intentos" => 4, "puntaje" => 13];
    $coleccionPartidas[7] = ["palabraWordix" => "MELON", "jugador" => "jose", "intentos" => 5, "puntaje" => 11];
    $coleccionPartidas[8] = ["palabraWordix" => "NORTE", "jugador" => "jose", "intentos" => 1, "puntaje" => 17];
    $coleccionPartidas[9] = ["palabraWordix" => "RATON", "jugador" => "juan", "intentos" => 3, "puntaje" => 14];
    return $coleccionPartidas;
}

/**
 * La función muestra un menú de opciones que el usuario puede seleccionar.
 * @param string $usuario
 * @return int $opcion
 */

function seleccionarOpcion($usuario)
{
    echo "Hola " . $usuario . ", elegí una opción del 1 al 8: \n";
    echo "********************************************************************************\n";
    echo "*  1: Jugar con palabra elegida.                                               *\n";
    echo "*  2: Jugar con palabra aleatoria.                                             *\n";
    echo "*  3: Mostrar una partida.                                                     *\n";
    echo "*  4: Mostrar la primer partida ganada de un jugador.                          *\n";
    echo "*  5: Mostrar el resumen de un jugador.                                        *\n";
    echo "*  6: Mostrar listado de partidas ordenadas por jugador y palabra.             *\n";
    echo "*  7: Agregar una palabra a la colección de Wordix.                            *\n";
    echo "*  8: Salir de wordix.                                                         *\n";
    echo "********************************************************************************\n";
    echo "Elegir número de opción: ";
    $opcion = trim(fgets(STDIN));
    if ($opcion > 8 || $opcion <= 0) {
        do {
            echo "Por favor, elegí una opción válida: ";
            $opcion = trim(fgets(STDIN));
        } while ($opcion > 8 || $opcion <= 0);
    }
  // return $partidas;
}



/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:


$partida = jugarWordix("LIMON", strtolower("martin"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
