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
        "NARIZ", "TIGRE", "BICIS", "LIMON", "FRENO"
    ];

    return ($coleccionPalabras);
}

/**
 * Se obtiene los datos de la partida con palabra elegida
 * @return array
 */

function palabraElegida()
{

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

        $collecionElegida[$i] = jugarWordix($palabra, $nombre);
        $i = $i + 1;
        echo "¿Desea seguir jugando? (s/n)";
        $respuesta = trim(fgets(STDIN));
    } while ($respuesta == "s" || $respuesta == "S");
    $datosPartidas  = cargarPartidas($collecionElegida);
    return $datosPartidas;
}

/**
 * Obtiene una colección de partidas
 * @param array $partidas
 */

function cargarPartidas($partidas)
{

    $cantPartidas = count($partidas);
    for ($i = 0; $i < $cantPartidas; $i++) {
        $partidas[$i]["palabraWordix"];
        $partidas[$i]["jugador"];
        $partidas[$i]["intentos"];
        $partidas[$i]["puntaje"];
    }
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
