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
 * Retorna un arreglo indexado que contiene una colección de palabras legales para jugar Wordix
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
 * Retorna un arreglo indexado compuesto por arreglos asociativos que guardan la información
 * de cada partida jugada
 *
 * @return array
 */
function cargarColeccionPartidas()
{
    $coleccionPartidasBase = [];
    $coleccionPartidasBase[0] = ["palabraWordix" => "QUESO", "jugador" => "juan", "intentos" => 5, "puntaje" => 10];
    $coleccionPartidasBase[1] = ["palabraWordix" => "CASAS", "jugador" => "pedro", "intentos" => 3, "puntaje" => 14];
    $coleccionPartidasBase[2] = ["palabraWordix" => "QUESO", "jugador" => "maria", "intentos" => 6, "puntaje" => 12];
    $coleccionPartidasBase[3] = ["palabraWordix" => "LIMON", "jugador" => "ana", "intentos" => 2, "puntaje" => 14];
    $coleccionPartidasBase[4] = ["palabraWordix" => "FUEGO", "jugador" => "juan", "intentos" => 4, "puntaje" => 12];
    $coleccionPartidasBase[5] = ["palabraWordix" => "HUEVO", "jugador" => "fer", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasBase[6] = ["palabraWordix" => "ARBOL", "jugador" => "juan", "intentos" => 4, "puntaje" => 13];
    $coleccionPartidasBase[7] = ["palabraWordix" => "MELON", "jugador" => "jose", "intentos" => 5, "puntaje" => 11];
    $coleccionPartidasBase[8] = ["palabraWordix" => "NORTE", "jugador" => "jose", "intentos" => 1, "puntaje" => 17];
    $coleccionPartidasBase[9] = ["palabraWordix" => "RATON", "jugador" => "juan", "intentos" => 3, "puntaje" => 14];
    return $coleccionPartidasBase;
}

/**
 * Verifica que el usuario ingrese un número de palabra distinto a los anteriores
 *
 * @param string $nombreJugador
 * @param string $palabra
 * @param array $coleccionPartidas
 * @return boolean
 */
function verificaNumeroDiferente($nombreJugador, $palabra, $coleccionPartidas)
{
    //boolean $palabraDiferente
    //int $iter

    $palabraDiferente = true;
    $iter = 0;

    while ($iter < count($coleccionPartidas) && $palabraDiferente == true) {
        if ($coleccionPartidas[$iter]["jugador"] == $nombreJugador) {
            if ($coleccionPartidas[$iter]["palabraWordix"] == $palabra) {
                $palabraDiferente = false;
            }
        }
        $iter++;
    }
    return $palabraDiferente;
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
    return ($opcion);
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
