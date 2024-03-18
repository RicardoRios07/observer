<?php

interface Observador
{
    public function update($data);
}


class Observable
{
    private $observadores = [];
    
    public function attach(Observador $observador)
    {
        $this->observadores[] = $observador;
    }

    public function detach(Observador $observador){
        $key = array_search($observador, $this->observadores, true);
            if ($key !== false){
                unset($this->observadores[$key]);
            }
    }

    public function notify($data){
        foreach ($this->observadores as $observador){
            $observador->update($data);
        }
    }
}

class ConcreteObserver implements Observador{
    public function update($data){
        echo "RECIVED UPDATE: $data\n";
    }
    }


    $sensorTemperatura = new Observable();
    $sensorHumedad = new Observable();

    $estacionCentral = new ConcreteObserver();

    $sensorTemperatura->attach($estacionCentral);
    $sensorHumedad->attach($estacionCentral);

    $sensorTemperatura->notify("Iniciando sensor temperatura!<BR>");

    sleep(1);

    $sensorTemperatura->notify("Hora: " . date('d-m-Y H:i:s') . " - Temperatura: 20 grados!<BR>");

    sleep(1);

    $sensorTemperatura->notify("Hora: " . date('d-m-Y H:i:s') . " - Temperatura: 18 grados!<BR>");

    $sensorHumedad->notify("Iniciando sensor humedad!<BR>");

    sleep(1);

    $sensorHumedad->notify("Hora: " . date('d-m-Y H:i:s') . " - Humedad: 67%!<BR>");

    sleep(1);
    $sensorHumedad->notify("Adios!<BR>");

    $sensorHumedad->detach($estacionCentral);

?>