<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->decimal('AAA_price', 8, 2);
        });

        DB::unprepared('
        CREATE OR REPLACE FUNCTION update_AAA_price() RETURNS TRIGGER AS $$
        BEGIN
            NEW."AAA_price" := NEW.price * 1.15;
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER update_AAA_price
        BEFORE INSERT OR UPDATE ON products
        FOR EACH ROW
        EXECUTE FUNCTION update_AAA_price();
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar el trigger correctamente, especificando la tabla
        DB::unprepared('
            DROP TRIGGER IF EXISTS update_AAA_price ON products;
            DROP FUNCTION IF EXISTS update_AAA_price;
        ');

        Schema::dropIfExists('products');
    }
};
