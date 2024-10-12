<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class PasajeroController extends Controller
{
    public function pasajerosllegantes(Request $request)
    {
        $fechaLlegada = $request->searchFechaFin;

        if(!$request->searchFechaFin)
        {
            $fechaInicio = Carbon::today()->toDateString();
            $fechaLlegada = Carbon::today()->addDays(7)->toDateString();
        }

        $reservas = Reserva::whereHas('detallestours', function ($query) use ($fechaLlegada) {
            // Filtrar solo los detalles de tours cuya fecha es la primera fecha y coincide con $fechaLlegada
            $query->where('fecha_viaje', '=', $fechaLlegada)
                ->where('fecha_viaje', '=', function ($subquery) {
                    // Subconsulta para obtener la primera fecha de detallestours para cada reserva
                    $subquery->select('fecha_viaje')
                            ->from('detalle_reservas')
                            ->whereColumn('detalle_reservas.reserva_id', 'reservas.id')
                            ->orderBy('fecha_viaje') // Ordenar por fecha para obtener la primera
                            ->limit(1); // Limitar a la primera fecha
                });
        })->where('confirmado',1)->get();
        $i = 0;
        return view('pages.pasajeros.llegantes',compact('reservas','i','fechaLlegada'));
    }

    public function bienvenida(Request $request)
    {
        $reserva = Reserva::find($request->id);
        $mensaje = "¡Hola, *".$reserva->pasajeroprincipal()->nombreCompleto."!*✈\n\n";
        $mensaje .= "Estamos muy emocionados por tu próxima aventura en Perú 🇵🇪 y queremos asegurarnos de que todo esté bien coordinado para tu llegada. Para ofrecerte el mejor servicio, necesitamos que nos confirmes algunos detalles\n\n";
        $mensaje .= "⿡ Itinerarios de vuelos (internacionales e internos):\n Por favor, confirma las horas de llegada y salida de tus vuelos para que podamos organizar los traslados de forma eficiente. 🕒\n\n";
        $mensaje .= "⿢ Hoteles:\n * Si ya tienes reservas de hotel, indícanos el nombre\n * Si reservaste los hoteles con nosotros, no te preocupes porque ya todo esta en orden\n * Si aún no has reservado, podemos ayudarte 🕒\n\n";
        $mensaje .= "🏨📸 Mi nombre es *".\Auth::user()->nombre."* y estará a tu disposición para cualquier pregunta que tengas antes o durante tu viaje. No dudes en escribirme si necesitas alguna información adicional. 🗺 ¡En Jisa Adventure estamos contando los días para recibirte con los brazos abiertos! 🙌✨";
        
        $mensajeCodificado = urlencode($mensaje);
        $numero = preg_replace('/[^0-9]/', '', $reserva->pasajeroprincipal()->celular);

        $link = "https://api.whatsapp.com/send/?phone=".$numero."&text=".$mensajeCodificado;
        return redirect()->to($link);
    }
}
