<?php

namespace App\Http\Controllers;

use App\Models\InformationCompany;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendWhatsapp(Request $request)
    {
        $informationCompany = InformationCompany::find(1);

        if (!$informationCompany || empty($informationCompany->contact_wa)) {
            return redirect()->back()->with('error', 'Nomor telepon WhatsApp perusahaan tidak ditemukan.');
        }

        $phone = $informationCompany->contact_wa;
        $text = urlencode($informationCompany->text_wa ?? 'Halo');

        return redirect("https://api.whatsapp.com/send?phone={$phone}&text={$text}");
    }
}
