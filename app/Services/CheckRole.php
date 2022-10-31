<?php

namespace App\Services;

/**
 *
 */
class checkRole
{
     public static function check($email)
     {
          // $editors = explode(',', env('EDITOR'));
          // $authors = explode(',', env('AUTHOR'));
          $admins = explode(',', config('role.admin'));
          if (in_array($email, $admins)) {
               return [1, 'admin'];
          }
          return [0, 'user'];
          // return (in_array($email, $admins)) ? 1 : 0;
     }
}
