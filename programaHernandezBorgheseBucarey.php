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
    $coleccionPalabrasBase = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "NARIZ", "TIGRE", "BICIS", "LIMON", "FRENO",
        "MONOS", "ARBOL", "GORRO", "NORTE", "RATON",
    ];

    return ($coleccionPalabrasBase);
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
    //int $i

    $palabraDiferente = true;
    $i = 0;

    while ($i < count($coleccionPartidas) && $palabraDiferente == true) {
        if ($coleccionPartidas[$i]["jugador"] == $nombreJugador) {
            if ($coleccionPartidas[$i]["palabraWordix"] == $palabra) {
                $palabraDiferente = false;
            }
        }
        $i++;
    }
    return $palabraDiferente;
}

/**
 * Imprime por pantalla los datos de una partida
 *
 * @param array $coleccionPartidas
 * @param int $numPartida
 *
 */
function imprimirPartida($coleccionPartidas, $numPartida)
{
    echo "--------------------------------------------------------------------------------\n";
    echo "Partida WORDIX N°" . $numPartida . ": Palabra " . $coleccionPartidas[$numPartida - 1]["palabraWordix"] . "\n";
    echo "Jugador: " . $coleccionPartidas[$numPartida - 1]["jugador"] . "\n";
    echo "Puntaje: " . $coleccionPartidas[$numPartida - 1]["puntaje"] . " puntos\n";
    echo "Intentos: " . $coleccionPartidas[$numPartida - 1]["intentos"] . "\n";
    echo "--------------------------------------------------------------------------------\n";
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



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
// int $opcion, $numPalabra, $numPartida, $iter
// string $nombreJugador
// boolean $numEntre, $numDiferente
// array $coleccionPalabras, $coleccionPartidas

//Inicialización de variables:
$coleccionPalabras = cargarColeccionPalabras();
$coleccionPartidas = cargarColeccionPartidas();

do {
    echo "--------------------------------------------------------------------------------\n";
    echo "||                              MENÚ PRINCIPAL                                ||\n";
    echo "||                                                                            ||\n";
    echo "|| Ingrese por teclado el número que corresponda a la opción elegida:         ||\n";
    echo "||                                                                            ||\n";
    echo "|| [1] Para jugar al Wordix con una palabra elegida                           ||\n";
    echo "|| [2] Para jugar al Wordix con una palabra aleatoria                         ||\n";
    echo "|| [3] Para mostrar una partida                                               ||\n";
    echo "|| [4] Para mostrar la primer partida ganadora                                ||\n";
    echo "|| [5] Para mostrar resumen de jugador                                        ||\n";
    echo "|| [6] Para mostrar listado de partidas ordenadas por jugador y por palabras  ||\n";
    echo "|| [7] Para agregar una palabra de 5 letras a Wordix                          ||\n";
    echo "|| [8] Para finaizar el juego                                                 ||\n";
    echo "--------------------------------------------------------------------------------\n";
    echo "\n";
    echo "Opción elegida: ";
    $opcion = trim(fgets(STDIN));
    echo "\n";

    switch ($opcion) {
        case 1:

            // jugar al Wordix con una palabra elegida
            echo "Ingrese su nombre de jugador: ";
            $nombreJugador = trim(fgets(STDIN));
            echo "Jugará con una palabra elegida entre las " . count($coleccionPalabras) . " 
            palabras que tiene cargado el juego\n";
            echo "Ingrese un número entre 1 y " . count($coleccionPalabras) . " para jugar: ";
            do {
                // verifica número correcto
                $numPalabra = solicitarNumeroEntre(1, count($coleccionPalabras));
                // verifica número no elegido anteriormente
                $numDiferente = verificaNumeroDiferente($nombreJugador, $coleccionPalabras[$numPalabra - 1], $coleccionPartidas);
                if (!$numDiferente) {
                    echo "El número ingresado corresponde a una palabra ya jugada \n";
                    echo "Por favor ingrese un número distinto: ";
                }
            } while (!$numDiferente);
            array_push($coleccionPartidas, jugarWordix($coleccionPalabras[$numPalabra - 1], $nombreJugador));
            break;

        case 2:

            // jugar al Wordix con una palabra aleatoria
            echo "Ingrese su nombre de jugador: ";
            $nombreJugador = trim(fgets(STDIN));
            echo "Jugará con una palabra elegida al azar de entre las " . count($coleccionPalabras) . " 
            palabras que tiene cargado el juego\n";
            do {
                // genera un número aleatorio
                $numPalabra = random_int(1, count($coleccionPalabras));
                // verifica número no elegido anteriormente
                $numDiferente = verificaNumeroDiferente($nombreJugador, $coleccionPalabras[$numPalabra - 1], $coleccionPartidas);
            } while (!$numDiferente);
            echo "\n";
            echo "El número de palabra elegido al azar es el: " . $numPalabra . "\n";
            echo "\n";
            array_push($coleccionPartidas, jugarWordix($coleccionPalabras[$numPalabra - 1], $nombreJugador));
            break;

        case 3:

            // mostrar una partida
            echo "Ingrese un número de partida para mostrar en pantalla de entre " . count($coleccionPartidas) . " partidas existentes: ";
            $numPartida = solicitarNumeroEntre(1, count($coleccionPartidas));
            imprimirPartida($coleccionPartidas, $numPartida);
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 4:

            // mostrar la primer partida ganadora
            echo "Ingrese el nombre de un jugador para visualizar la primer partida que gano: ";
            $nombreJugador = trim(fgets(STDIN));
            $iter = 1;
            $jugadorEncontrado = false;
            $partidaGanadora = false;
            do {
                if ($coleccionPartidas[$iter - 1]["jugador"] == $nombreJugador) {
                    $jugadorEncontrado = true;
                    if ($coleccionPartidas[$iter - 1]["puntaje"] > 0) {
                        $partidaGanadora = true;
                        imprimirPartida($coleccionPartidas, $iter);
                    }
                }
                $iter++;
            } while ($iter <= count($coleccionPartidas) && $partidaGanadora == false);
            if ($jugadorEncontrado == false) {
                echo "\n";
                echo "El jugador " . $nombreJugador . " No ha jugado ninguna partida todavía \n";
            } elseif ($partidaGanadora == false) {
                echo "\n";
                echo "El jugador " . $nombreJugador . " No ha ganado ninguna partida todavía \n";
            }
            echo "\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 5:

            // Para mostrar resumen de jugador
            echo "Ingrese el nombre de un jugador para visualizar un resumen de todas sus partidas jugadas: ";
            $nombreJugador = trim(fgets(STDIN));
            $resumenJugador = [
                "jugador" => $nombreJugador,
                "partidas" => 0,
                "puntaje" => 0,
                "victorias" => 0,
                "intento1" => 0, "intento2" => 0, "intento3" => 0,
                "intento4" => 0, "intento5" => 0, "intento6" => 0
            ];
            for ($iter = 0; $iter < count($coleccionPartidas); $iter++) {
                if ($coleccionPartidas[$iter]["jugador"] == $nombreJugador) {
                    $resumenJugador["partidas"] += 1;
                    if ($coleccionPartidas[$iter]["puntaje"] > 0) {
                        $resumenJugador["puntaje"] += $coleccionPartidas[$iter]["puntaje"];
                        $resumenJugador["victorias"] += 1;
                        switch ($coleccionPartidas[$iter]["intentos"]) {
                            case 1:
                                $resumenJugador["intento1"] += 1;
                                break;
                            case 2:
                                $resumenJugador["intento2"] += 1;
                                break;
                            case 3:
                                $resumenJugador["intento3"] += 1;
                                break;
                            case 4:
                                $resumenJugador["intento4"] += 1;
                                break;
                            case 5:
                                $resumenJugador["intento5"] += 1;
                                break;
                            case 6:
                                $resumenJugador["intento6"] += 1;
                                break;
                        }
                    }
                }
            }
            echo "\n";
            if ($resumenJugador["partidas"] == 0) {
                echo "El jugador ingresado no ha jugado ninguna partida todavía \n";
            } else {
                $porcVictorias = ($resumenJugador["victorias"] * 100) / $resumenJugador["partidas"];
                echo "--------------------------------------------------------------------------------\n";
                echo "Jugador: " . $nombreJugador . "\n";
                echo "Partidas: " . $resumenJugador["partidas"] . "\n";
                echo "Puntaje total: " . $resumenJugador["puntaje"] . "\n";
                echo "Victorias: " . $resumenJugador["victorias"] . "\n";
                echo "Porcentaje Victorias: " . $porcVictorias . "%\n";
                echo "Adivinadas:\n";
                echo "      Intento 1: " . $resumenJugador["intento1"] . "\n";
                echo "      Intento 2: " . $resumenJugador["intento2"] . "\n";
                echo "      Intento 3: " . $resumenJugador["intento3"] . "\n";
                echo "      Intento 4: " . $resumenJugador["intento4"] . "\n";
                echo "      Intento 5: " . $resumenJugador["intento5"] . "\n";
                echo "      Intento 6: " . $resumenJugador["intento6"] . "\n";
                echo "--------------------------------------------------------------------------------\n";
            }
            echo "\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 6:

            // Para mostrar listado de partidas ordenadas por jugador y por palabras
            //uasort($coleccionPartidas, );
            print_r($coleccionPartidas);
            echo "\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 7:

            // Para agregar una palabra de 5 letras a Wordix
            $pal5Letras = leerPalabra5Letras();
            array_push($coleccionPalabras, $pal5Letras);
            break;

        case 8:
            // Finaliza el juego
            break;
        default:
            // Mensaje de error
            echo "\n";
            echo "Usted ha ingresado una opción no válida.\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer el error
            $opcion = trim(fgets(STDIN));
            break;
    }
} while ($opcion != 8);

echo "\n";
echo "Juego finalizado! \n";
echo "\n";


$partida = jugarWordix("LIMON", strtolower("martin"));
