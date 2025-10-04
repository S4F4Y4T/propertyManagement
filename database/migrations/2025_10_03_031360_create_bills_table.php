<?php

use App\Models\BillCategory;
use App\Models\Flat;
use App\Models\Tenant;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Add this import if PaymentStatusEnum exists in your project
use App\Enums\PaymentStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('due_amount',10,2)->default(0);
            $table->decimal('paid_amount',10,2)->default(0);
            $table->string('payment_status')->default(PaymentStatusEnum::UNPAID->value);

            $table->text('note')->nullable();
            
            $table->foreignIdFor(BillCategory::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tenant::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Flat::class)->constrained()->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
