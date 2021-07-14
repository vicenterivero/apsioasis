<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\centros_consumo;
use App\Models\centros_consumo_detalle;
use App\Models\centros_consumo_horario;
use App\Models\hotele;
use App\Models\propiedade;

class ApiController extends Controller
{
    public function restaurantes(centros_consumo $centros_consumo, centros_consumo_horario $centros_consumo_horarios)
    {
        $hora = date('H:i:s');
      /*   $hora= "13:30:00"; */
        $dia = date('w');
        $nombre = $centros_consumo::where('categoria_id', 'LIKE', 2)->get();
        $horario = $centros_consumo_horarios->where([
            ['dia', '=', $dia],
            ['hora_inicio', '<=', $hora],
            ['hora_final', '>=', $hora],
        ])->GET();
        $numero_restaurantes = count($nombre);
        $numero_horario = count($horario);
     if($numero_horario==0){

        $json=json_encode(array(
            'mensaje' => "No hay restaurantes abiertos"
        )
        );
        return "[".$json."]";



     } else{
         print "[";
        for ( $contador = 0;$contador < $numero_restaurantes;) {


            $contador++;
            $contador_array = $contador-1;
            if ($contador_array == $numero_restaurantes) {
                $contador_array = $numero_restaurantes-1;
            }
            $solicitarrestaurante = json_decode($nombre);
            $sincor = $solicitarrestaurante[$contador_array];
            $idrestaurante = $sincor->id;
            $nombre_restaurante = $sincor->nombre;
            $nombre_restaurante_concepto = $sincor->concepto_es;
            $logo = $sincor->logo;
            $img_portada = $sincor->img_portada;
            $logofin='https://api-onow.oasishoteles.net/'.$logo;
            $img_portadafin='https://api-onow.oasishoteles.net/'.$img_portada;
           /*  echo "restaurantes";
            echo $idrestaurante."<br>"; */

            for ($contador_horario = 0;$contador_horario < $numero_horario;) {

                $contador_horario++;
                $contador_array_horario = $contador_horario - 1;
                if ($contador_array_horario == $numero_horario) {
                    $contador_array_horario = $numero_horario - 1;
                }
                $solicitarhorario = json_decode($horario);
                $sincorhorario = $solicitarhorario[$contador_array_horario];
                $idllaveforanea = $sincorhorario->centro_consumo_id;
                $horario_ini = $sincorhorario->hora_inicio;
                $horario_fin = $sincorhorario->hora_final;
                $horario_inicial= substr($horario_ini, 0, 5);
                $horario_finalista= substr($horario_fin, 0, 5);


                if($horario_inicial>="12:00"){
                    if($horario_inicial=="13:00"){
                        $horario_inicial="01:00";
                    }
                    if($horario_inicial=="14:00"){
                        $horario_inicial="02:00";
                    }
                    if($horario_inicial=="15:00"){
                        $horario_inicial="03:00";
                    }
                    if($horario_inicial=="16:00"){
                        $horario_inicial="04:00";
                    }
                    if($horario_inicial=="17:00"){
                        $horario_inicial="05:00";
                    }
                    if($horario_inicial=="18:00"){
                        $horario_inicial="06:00";
                    }
                    if($horario_inicial=="19:00"){
                        $horario_inicial="07:00";
                    }
                    if($horario_inicial=="20:00"){
                        $horario_inicial="08:00";
                    }
                    if($horario_inicial=="21:00"){
                        $horario_inicial="09:00";
                    }
                    if($horario_inicial=="22:00"){
                        $horario_inicial="10:00";
                    }
                    if($horario_inicial=="23:00"){
                        $horario_inicial="11:00";
                    }
                    $horario_inicio=$horario_inicial.' PM';
                }else{
                    $horario_inicio=$horario_inicial.' AM';

                }
                if($horario_finalista>="12:00"){
                    if($horario_finalista=="13:00"){
                        $horario_finalista="01:00";
                    }
                    if($horario_finalista=="14:00"){
                        $horario_finalista="02:00";
                    }
                    if($horario_finalista=="15:00"){
                        $horario_finalista="03:00";
                    }
                    if($horario_finalista=="16:00"){
                        $horario_finalista="04:00";
                    }
                    if($horario_finalista=="17:00"){
                        $horario_finalista="05:00";
                    }
                    if($horario_finalista=="18:00"){
                        $horario_finalista="06:00";
                    }
                    if($horario_finalista=="19:00"){
                        $horario_finalista="07:00";
                    }
                    if($horario_finalista=="20:00"){
                        $horario_finalista="08:00";
                    }
                    if($horario_finalista=="21:00"){
                        $horario_finalista="09:00";
                    }
                    if($horario_finalista=="22:00"){
                        $horario_finalista="10:00";
                    }
                    if($horario_finalista=="23:00"){
                        $horario_finalista="11:00";
                    }
                    $horario_final=$horario_finalista.' PM';
                }else{
                    $horario_final=$horario_finalista.' AM';

                }
                if($horario_inicial=="00:00"){
                    $horario_inicio='12:00'.' AM';
                }

             /*    echo $idllaveforanea."<br>" ; */
                if($idrestaurante==$idllaveforanea){
                  /*   print $contador_horario."<br>"; */
                    /*echo $nombre_restaurante."<br>";
                    echo $nombre_restaurante_concepto."<br>";
                    echo $horario_inicio."<br>";
                    echo $horario_final."<br>";
                    echo $idrestaurante."<br>";
                    echo $idllaveforanea."<br>"; */

                    $json=json_encode(array(
                        'nombre'=>$nombre_restaurante,
                        'concepto'=>$nombre_restaurante_concepto,
                        /* 'logo'=>$logofin,
                        'img_portada'=>$img_portadafin, */
                        'horario_inicio'=>$horario_inicio,
                        'horario_final'=>$horario_final,
                        'categoria'=>2
                    )
                    );

                        print $json.",";


                }

            }




        }
        print "{".'"dia":'.$dia."}]";
     }

    }
    public function bares(centros_consumo $centros_consumo, centros_consumo_horario $centros_consumo_horarios)
    {
        $hora = date('H:i:s');
        /* $hora= "18:20:00"; */
        $dia = date('w');
        $nombre = $centros_consumo::where('categoria_id', 'LIKE', 3)->get();
        $horario = $centros_consumo_horarios->where([
            ['dia', '=', $dia],
            ['hora_inicio', '<=', $hora],
            ['hora_final', '>=', $hora],
        ])->GET();
        $horariobar = $centros_consumo_horarios->where([
            ['dia', '=', $dia],
            ['hora_inicio', '>=', '06:30:00'],
            ['hora_final', '>=', $hora],
        ])->GET();
        $horariobardos = $centros_consumo_horarios->where([
            ['dia', '=', $dia],
            ['hora_inicio', '<=', '00:00:00'],
            ['hora_final', '>=', '06:00:00'],
        ])->GET();
        $numero_restaurantes = count($nombre);
        $numero_horario = count($horario);
        $numero_horario1 = count($horariobar);
        $numero_horario2 = count($horariobardos);
/*         echo $numero_horario;
        echo $numero_horario1;
        echo $numero_horario2;
        return $horariobardos; */
     if($numero_horario==0){

        $json=json_encode(array(
            'mensaje' => "No hay bares abiertos"
        )
        );
        return "[".$json."]";
     }elseif($numero_horario1==0){
        $json=json_encode(array(
            'mensaje' => "No hay bares abiertos"
        )
        );
        return "[".$json."]";
     }elseif($numero_horario2==0){
        $json=json_encode(array(
            'mensaje' => "No hay bares abiertos"
        )
        );
        return "[".$json."]";
     } else{
         print "[";
        for ( $contador = 0;$contador < $numero_restaurantes;) {


            $contador++;
            $contador_array = $contador-1;
            if ($contador_array == $numero_restaurantes) {
                $contador_array = $numero_restaurantes-1;
            }
            $solicitarrestaurante = json_decode($nombre);
            $sincor = $solicitarrestaurante[$contador_array];
            $idrestaurante = $sincor->id;
            $nombre_restaurante = $sincor->nombre;
            $nombre_restaurante_concepto = $sincor->concepto_es;
            $logo = $sincor->logo;
            $img_portada = $sincor->img_portada;
            $logofin='https://api-onow.oasishoteles.net/'.$logo;
            $img_portadafin='https://api-onow.oasishoteles.net/'.$img_portada;
           /*  echo "restaurantes";
            echo $idrestaurante."<br>"; */

            for ($contador_horario = 0;$contador_horario < $numero_horario;) {

                $contador_horario++;
                $contador_array_horario = $contador_horario - 1;
                if ($contador_array_horario == $numero_horario) {
                    $contador_array_horario = $numero_horario - 1;
                }
                $solicitarhorario = json_decode($horario);
                $sincorhorario = $solicitarhorario[$contador_array_horario];
                $idllaveforanea = $sincorhorario->centro_consumo_id;
                $horario_ini = $sincorhorario->hora_inicio;
                $horario_fin = $sincorhorario->hora_final;
                $horario_inicial= substr($horario_ini, 0, 5);
                $horario_finalista= substr($horario_fin, 0, 5);

                if($horario_inicial>="12:00"){
                    if($horario_inicial=="13:00"){
                        $horario_inicial="01:00";
                    }
                    if($horario_inicial=="14:00"){
                        $horario_inicial="02:00";
                    }
                    if($horario_inicial=="15:00"){
                        $horario_inicial="03:00";
                    }
                    if($horario_inicial=="16:00"){
                        $horario_inicial="04:00";
                    }
                    if($horario_inicial=="17:00"){
                        $horario_inicial="05:00";
                    }
                    if($horario_inicial=="18:00"){
                        $horario_inicial="06:00";
                    }
                    if($horario_inicial=="19:00"){
                        $horario_inicial="07:00";
                    }
                    if($horario_inicial=="20:00"){
                        $horario_inicial="08:00";
                    }
                    if($horario_inicial=="21:00"){
                        $horario_inicial="09:00";
                    }
                    if($horario_inicial=="22:00"){
                        $horario_inicial="10:00";
                    }
                    if($horario_inicial=="23:00"){
                        $horario_inicial="11:00";
                    }
                    $horario_inicio=$horario_inicial.' PM';
                }else{
                    $horario_inicio=$horario_inicial.' AM';

                }
                if($horario_finalista>="12:00"){
                    if($horario_finalista=="13:00"){
                        $horario_finalista="01:00";
                    }
                    if($horario_finalista=="14:00"){
                        $horario_finalista="02:00";
                    }
                    if($horario_finalista=="15:00"){
                        $horario_finalista="03:00";
                    }
                    if($horario_finalista=="16:00"){
                        $horario_finalista="04:00";
                    }
                    if($horario_finalista=="17:00"){
                        $horario_finalista="05:00";
                    }
                    if($horario_finalista=="18:00"){
                        $horario_finalista="06:00";
                    }
                    if($horario_finalista=="19:00"){
                        $horario_finalista="07:00";
                    }
                    if($horario_finalista=="20:00"){
                        $horario_finalista="08:00";
                    }
                    if($horario_finalista=="21:00"){
                        $horario_finalista="09:00";
                    }
                    if($horario_finalista=="22:00"){
                        $horario_finalista="10:00";
                    }
                    if($horario_finalista=="23:00"){
                        $horario_finalista="11:00";
                    }
                    $horario_final=$horario_finalista.' PM';
                }else{
                    $horario_final=$horario_finalista.' AM';

                }
                if($horario_inicial=="00:00"){
                    $horario_inicio='12:00'.' AM';
                }

             /*    echo $idllaveforanea."<br>" ; */
                if($idrestaurante==$idllaveforanea){
                  /*   print $contador_horario."<br>"; */
                    /*echo $nombre_restaurante."<br>";
                    echo $nombre_restaurante_concepto."<br>";
                    echo $horario_inicio."<br>";
                    echo $horario_final."<br>";
                    echo $idrestaurante."<br>";
                    echo $idllaveforanea."<br>"; */

                    $json=json_encode(array(
                        'nombre'=>$nombre_restaurante,
                        'concepto'=>$nombre_restaurante_concepto,

                        'horario_inicio'=>$horario_inicio,
                        'horario_final'=>$horario_final,
                        'categoria'=>3
                    )
                    );

                        print $json.",";


                }

            }




        }
        print "{".'"dia":'.$dia."}]";
     }
    }













    public function detalle(centros_consumo_detalle $centros_consumo_detalle, centros_consumo_horario $centros_consumo_horarios)
    {
        $hora = date('H:i:s');
        $dia = date('w');
        $nombre = $centros_consumo_detalle->get();
        $horario = $centros_consumo_horarios->where([
            ['dia', '=', $dia],
            ['hora_inicio', '<', $hora],
            ['hora_final', '>', $hora],
        ])->GET();
        return response()->json(
            $nombre,
            $horario
        );
    }
    public function horario(centros_consumo_horario $centros_consumo_horarios)
    {
        $nombre = $centros_consumo_horarios->get();

        return response()->json(
            $nombre
        );
    }
    public function hoteles(hotele $hoteles)
    {
        $nombre = $hoteles->get();

        return response()->json(
            $nombre
        );
    }
    public function propiedad(propiedade $centros_consumo)
    {
        $nombre = $centros_consumo->get();

        return response()->json(
            $nombre
        );
    }
}
