<?php
namespace App\Traits;

trait ShowRate
{
    public function showRate($rate)
    {
        $rating = '';

        for ($i = 0; $i < 5; $i++) {
            $rating .= '<span class="fa-stack stars">';
            $rating .= '<i class="fa fa-star fa-stack-1x"></i>';

            if ($rate > 0.5) {
                $rating .= '<i class="fa fa-star fa-stack-1x"></i>';
            } elseif ($rate < 0.5 && $rate > 0) {
                $rating .= '<i class="fa fa-star-half-o fa-stack-1x"></i>';
            } else {
                $rating .= '<i class="fa fa-star fa-stack-1x fa-inverse"></i>';
            }
            $rate --;
            $rating .= '</span>';
        }

        echo $rating;
    }
}