<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("ficha_eval");
            $table->string("eva_eval");
            $table->string("frecuencia_eval");
            $table->string("exac_eval");
            $table->string("inicio_eval");
            $table->string("inicio_tiempo_eval");
            $table->string("dolor_eval");
            $table->string("retraccion_eval");
            $table->string("parestecia_eval");
            $table->string("hiperalgesia_eval");
            $table->string("hiperalgesia_zona_eval");
            $table->string("limitacion_eval");
            $table->string("localizacion_eval");
            $table->string("irradiacion_eval");
            $table->string("irradiacion_zona_eval");
            $table->string("observaciones_eval");
            $table->string("diagnostico_eval");
            $table->string("chc_trat");
            $table->string("cf_trat");
            $table->string("tiempo_trat");
            $table->string("frecuencia_ultrasonido_trat");
            $table->string("intensidad_ultrasonido_trat");
            $table->string("ciclo_ultrasonido_trat");
            $table->string("tiempo_ultrasonido_trat");
            $table->string("dolor_laser_trat");
            $table->string("tenosinovitis_laser_trat");
            $table->string("esguince_laser_trat");
            $table->string("tension_laser_trat");
            $table->string("rusa_corriente_trat");
            $table->string("interferencial_corriente_trat");
            $table->string("alto_corriente_trat");
            $table->string("tens_corriente_trat");
            $table->string("estiramiento_trat");
            $table->string("klapp_metodo_trat")->nullable();
            $table->string("william_metodo_trat")->nullable();
            $table->string("wilson_metodo_trat")->nullable();
            $table->string("fnp_metodo_trat")->nullable();
            $table->string("codman_metodo_trat")->nullable();
            $table->string("burguer_metodo_trat")->nullable();
            $table->string("kaltenbron_metodo_trat")->nullable();
            $table->string("feldenkrais_metodo_trat")->nullable();
            $table->string("isometrico_fortalecimiento_trat")->nullable();
            $table->string("isocarga_fortalecimiento_trat")->nullable();
            $table->string("nocarga_fortalecimiento_trat")->nullable();
            $table->string("bozu_fortalecimiento_trat")->nullable();
            $table->string("theraband_fortalecimiento_trat")->nullable();
            $table->string("reduccion_trat");
            $table->string("rolido_marcha_trat")->nullable();
            $table->string("sentado_marcha_trat")->nullable();
            $table->string("arrastre_marcha_trat")->nullable();
            $table->string("puntos_marcha_trat")->nullable();
            $table->string("rodillas_marcha_trat")->nullable();
            $table->string("bipedo_marcha_trat")->nullable();
            $table->string("descarga_marcha_trat")->nullable();
            $table->string("equilibrio_marcha_trat")->nullable();
            $table->string("coordinacion_marcha_trat")->nullable();
            $table->string("disocion_marcha_trat")->nullable();
            $table->string('consulta_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }
}
