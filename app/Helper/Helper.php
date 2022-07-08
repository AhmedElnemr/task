<?php


use Carbon\Carbon;

if (!function_exists('setting')) {
    function setting()
    {
        return \App\Models\Setting::orderBy('id', 'desc')->first();
    }
}

if (!function_exists('years_between_two_date')) {
    function years_between_two_date($first)
    {
        $d1 = new DateTime($first);
        $d2 = new DateTime(date('Y-m-d'));

        $diff = $d2->diff($d1);

        return $diff->y;
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}
if (!function_exists('user')) {
    function user()
    {
        return auth()->guard('user');
    }
}

if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('admin/' . $url);
    }
}

if (!function_exists('get_file')) {

    function get_file($file)
    {
        // Storage::exists( $file )
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $file_path = $file;
        } elseif ($file) {
            $file_path = asset('storage/uploads') . '/' . $file;
        } else {
            $file_path=asset('dashboard/assets/images/companies/img-1.png');
        }
        return $file_path;
    }//end
}


if (!function_exists('permissionsList')) {
    function permissionsList()
    {
        return \App\Models\Admin::findOrFail(auth()->guard('admin')->user()->id)
            ->permissions()
            ->pluck('name')->toArray();
    }
}

if (!function_exists('checkAdminHavePermission')) {
    function checkAdminHavePermission($permission_name)
    {
        if (in_array($permission_name, \App\Models\Admin::findOrFail(auth()->guard('admin')->user()->id)
            ->permissions()->pluck('name')
            ->toArray())) {
            return true;
        }
        return false;
    }
}
if (!function_exists('diffBetweenTwoDates')) {
    function diffBetweenTwoDates($date1)
    {
        try {
            $date2 = (\Carbon\Carbon::now())->toDateTimeString();

            $diff = abs(strtotime($date2) - strtotime($date1));

            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

            $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);

            $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
            return [$years, $months, $days, $hours, $minuts, $seconds];
        } catch (\Exception $exception) {
            return [0, 0, 0, 0, 0, 0];
        }

    }
}//end if


