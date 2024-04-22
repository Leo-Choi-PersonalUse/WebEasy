<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller as BaseController;

class PublicHolidays extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function get()
    {
        $response_en = Http::get('https://www.1823.gov.hk/common/ical/en.json');
        $response_tc = Http::get('http://www.1823.gov.hk/common/ical/tc.json');


        if ($response_en->successful() && $response_tc->successful()) {
            // -------- remove the utf-8 BOM ----
            $data_full_en = json_decode($this->removeUtf8Bom($response_en->body()), true);
            $data_full_tc = json_decode($this->removeUtf8Bom($response_tc->body()), true);

            $count = count($data_full_en["vcalendar"][0]['vevent']) == count($data_full_tc["vcalendar"][0]['vevent']) ? count($data_full_en["vcalendar"][0]['vevent']) : -1;

            if ($count == -1)
                return "API Error";

            $res = array();
            for ($i = 0; $i < $count; $i++) {
                $res[] = [
                    "uid" => $data_full_en["vcalendar"][0]['vevent'][$i]["uid"],
                    "summary_en" => $data_full_en["vcalendar"][0]['vevent'][$i]["summary"],
                    "summary_tc" => $data_full_tc["vcalendar"][0]['vevent'][$i]["summary"],
                    "dtstart" => explode('@', $data_full_en["vcalendar"][0]['vevent'][$i]["uid"])[0],
                ];
            }

            return $res;

        } else {
            // Handle the unsuccessful response_en
            $statusCode = $response_en->status();
            // Handle the error based on the status code
        }
    }

    private function removeUtf8Bom($str)
    {
        return str_replace("\xEF\xBB\xBF", '', $str);
    }
}