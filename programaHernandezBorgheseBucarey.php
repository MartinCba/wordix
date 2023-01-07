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
function cargarPartidas()
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
 * Cuenta la cantidad de partidas de un jugador, retorna true si es igual o mayor al número de palabras
 * @param string $nombreJugador
 * @param array $coleccionPartidas
 * @param int $cantPalabras
 * @return boolean
 */
function cuentaPartidasJugador($nombreJugador, $coleccionPartidas, $cantPalabras)
{
    //boolean $jugadorExcedido
    //int $iter, $contador
    $jugadorExcedido = false;
    $iter = 0;
    $contador = 0;

    do {
        if ($coleccionPartidas[$iter]["jugador"] == $nombreJugador) {
            $contador++;
            if ($contador >= $cantPalabras) {
                $jugadorExcedido = true;
            }
        }
        $iter++;
    } while ($iter < count($coleccionPartidas) && $jugadorExcedido == false);

    return $jugadorExcedido;
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
 * Muestra por pantalla un menú de opciones y retorna un entero correspondiente a una opción elegida
 * @return int
 */
function seleccionarOpcion()
{
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
        if ($opcion < 1 || $opcion > 8) {
            echo "Opción no válida, volverá a ser dirigido al menú principal \n";
            echo "Recuerde ingresar un valor entre 1 y 8. Presione cualquier tecla para continuar: \n";
            $stop = trim(fgets(STDIN)); // Detiene el programa para leer el error.
            echo "\n";
        }
    } while ($opcion < 1 || $opcion > 8);

    return $opcion;
}

/**
 * Este modulo recibe un nombre de jugador, un arreglo de partidas e indica cual fue su primera partida
 * ganada retornando el indice que le corresponde en el arreglo o -1 si no existe primer partida ganada
 * @param string $nombreJugador
 * @param array $coleccionPartidas
 * @return int
 */
function primerPartidaGanadora($nombreJugador, $coleccionPartidas)
{
    //int $iter, $indiceJugador
    //boolean $jugadorEncontrado, $partidaGanadora

    $iter = 0;
    $partidaGanadora = false;
    do {
        if ($coleccionPartidas[$iter]["jugador"] == $nombreJugador) {
            if ($coleccionPartidas[$iter]["puntaje"] > 0) {
                $partidaGanadora = true;
            }
        }
        $iter++;
    } while ($iter < count($coleccionPartidas) && $partidaGanadora == false);

    if ($partidaGanadora) {
        $indiceJugador = $iter - 1;
    } else {
        $indiceJugador = -1;
    }

    return $indiceJugador;
}

/**
 * Recibe un arreglo de palabras y una palabra para agregar al arreglo
 * Retorna el arreglo modificado
 * @param array $coleccionPalabras
 * @param string $pal5Letras
 * @return array
 */
function agregarPalabra($coleccionPalabras, $pal5Letras)
{
    //int $cantPalabras
    $cantPalabras = count($coleccionPalabras);
    $coleccionPalabras[$cantPalabras] = $pal5Letras;

    return $coleccionPalabras;
}

/**
 * Recibe el nombre de un jugador y una colección de partidas e imprime un resumen de esas partidas
 * En caso de que el jugador no exista será indicado también mediante un mensaje
 * @param string $nombreJugador
 * @param array $coleccionPartidas
 */
function resumenDelJugador($nombreJugador, $coleccionPartidas)
{
    //array $resumenJugador
    //int $iter
    //float $procVictorias

    $resumenJugador = [
        "jugador" => $nombreJugador,
        "partidas" => 0,
        "puntaje" => 0,
        "victorias" => 0,
        "intento1" => 0, "intento2" => 0, "intento3" => 0,
        "intento4" => 0, "intento5" => 0, "intento6" => 0
    ];
    for ($i = 0; $i < count($coleccionPartidas); $i++) {
        if ($coleccionPartidas[$i]["jugador"] == $nombreJugador) {
            $resumenJugador["partidas"] += 1;
            if ($coleccionPartidas[$i]["puntaje"] > 0) {
                $resumenJugador["puntaje"] += $coleccionPartidas[$i]["puntaje"];
                $resumenJugador["victorias"] += 1;
                switch ($coleccionPartidas[$i]["intentos"]) {
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
}

/**
 * Solicita a un usuario ingresar un nombre de jugador que empiece con una letra
 * Retorna el nombre en minusculas
 * @return string
 */
function solicitarJugador()
{
    //string $nombreJugador
    //boolean $sinLetra

    do {
        echo "Ingrese un nombre de jugador, debe empezar con una letra: ";
        $nombreJugador = trim(fgets(STDIN));
        if (!ctype_alpha($nombreJugador[0])) {
            $sinLetra = false;
            echo "Error. Ha ingresado un caracter que no es letra como inicial del nombre \n";
        } else {
            $sinLetra = true;
        }
    } while ($sinLetra == false);

    return strtolower($nombreJugador);
}

/**
 * Recibe un nombre de jugador y una colección de partidas
 * Retorna un booleano que indica si ese jugador tiene una partida guardada o no
 * @param string $nombreJugador
 * @param array $coleccionPartidas
 * @return boolean
 */
function buscarJugador($nombreJugador, $coleccionPartidas)
{
    //boolean $existeJugador
    //int $iter
    $existeJugador = false;
    $iter = 0;

    do {
        if ($coleccionPartidas[$iter]["jugador"] == $nombreJugador) {
            $existeJugador = true;
        }
        $iter++;
    } while ($iter < count($coleccionPartidas) && $existeJugador == false);

    return $existeJugador;
}

/**
 * Función de comparación utilizada para ordenar por nombre de palabra
 * @param string $a
 * @param string $b
 * @return int
 */
function cmp($a, $b)
{
    if ($a == $b) {
        $orden = 0;
    } elseif ($a < $b) {
        $orden = -1;
    } else {
        $orden = 1;
    }
    return $orden;
}

/**
 * Función de comparación utilizada para ordenar por nombre de jugador
 * @param string $a
 * @param string $b
 * @return int
 */
function cmp2($a, $b)
{
    if ($a["jugador"] == $b["jugador"]) {
        $orden = 0;
    } elseif ($a["jugador"] < $b["jugador"]) {
        $orden = -1;
    } else {
        $orden = 1;
    }
    return $orden;
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
$coleccionPartidas = cargarPartidas();

do {
    $opcion = seleccionarOpcion();

    switch ($opcion) {
        case 1:

            // jugar al Wordix con una palabra elegida
            $nombreJugador = solicitarJugador();
            echo "Jugará con una palabra elegida entre las " . count($coleccionPalabras) . "
            palabras que tiene cargado el juego\n";
            echo "Ingrese un número entre 1 y " . count($coleccionPalabras) . " para jugar: ";
            do {
                // verifica número correcto
                $numPalabra = solicitarNumeroEntre(1, count($coleccionPalabras));
                // filtra si el jugador ya jugo todas las palabras
                if (cuentaPartidasJugador($nombreJugador, $coleccionPartidas, count($coleccionPalabras)) == false) {
                    // verifica número no elegido anteriormente
                    $numDiferente = verificaNumeroDiferente($nombreJugador, $coleccionPalabras[$numPalabra - 1], $coleccionPartidas);
                }
                if (!$numDiferente) {
                    echo "El número ingresado corresponde a una palabra ya jugada \n";
                    echo "Por favor ingrese un número distinto: ";
                }
            } while (!$numDiferente);
            array_push($coleccionPartidas, jugarWordix($coleccionPalabras[$numPalabra - 1], $nombreJugador));
            echo "\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 2:

            // jugar al Wordix con una palabra aleatoria
            $nombreJugador = solicitarJugador();
            echo "Jugará con una palabra elegida al azar de entre las " . count($coleccionPalabras) . "
            palabras que tiene cargado el juego\n";
            do {
                // genera un número aleatorio
                $numPalabra = random_int(1, count($coleccionPalabras));
                // filtra si el jugador ya jugo todas las palabras
                if (cuentaPartidasJugador($nombreJugador, $coleccionPartidas, count($coleccionPalabras)) == false) {
                    // verifica número no elegido anteriormente
                    $numDiferente = verificaNumeroDiferente($nombreJugador, $coleccionPalabras[$numPalabra - 1], $coleccionPartidas);
                }
            } while (!$numDiferente);
            echo "\n";
            echo "El número de palabra elegido al azar es el: " . $numPalabra . "\n";
            echo "\n";
            array_push($coleccionPartidas, jugarWordix($coleccionPalabras[$numPalabra - 1], $nombreJugador));
            echo "\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
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

            $existeJugador = buscarJugador($nombreJugador, $coleccionPartidas);

            if ($existeJugador == false) {
                echo "\n";
                echo "El jugador " . $nombreJugador . " No ha jugado ninguna partida todavía \n";
            } else {
                $indiceJugador = primerPartidaGanadora($nombreJugador, $coleccionPartidas);
                if ($indiceJugador == -1) {
                    echo "\n";
                    echo "El jugador " . $nombreJugador . " No ha ganado ninguna partida todavía \n";
                } else {
                    imprimirPartida($coleccionPartidas, $indiceJugador + 1);
                }
            }

            echo "\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 5:

            //Para mostrar resumen de jugador  1
            $nombreJugador = solicitarJugador();

            resumenDelJugador($nombreJugador, $coleccionPartidas);

            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 6:

            // Para mostrar listado de partidas ordenadas por jugador y por palabras
            uasort($coleccionPartidas, 'cmp');
            uasort($coleccionPartidas, 'cmp2');

            print_r($coleccionPartidas);
            echo "\n";
            echo "Ingrese cualquier valor para volver al menú principal u 8 para finalizar: ";
            // Mensaje de parada para leer los resultados
            $opcion = trim(fgets(STDIN));
            break;

        case 7:

            // Verifica palabra para agregarla a la colección!
            $pal5Letras = leerPalabra5Letras();

            // array_push($coleccionPalabras, $pal5Letras);
            $coleccionPalabras = agregarPalabra($coleccionPalabras, $pal5Letras);
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
