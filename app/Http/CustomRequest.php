<?php 

namespace App\Http;

use Illuminate\Http\Request as BaseRequest;

class CustomRequest extends BaseRequest {
    
  private $user;
    public function setUser( $user ) {
        return $this->user = $user;
    }
  
  public function getUser() {
      return  $this->user;
  }
  
}