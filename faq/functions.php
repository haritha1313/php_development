<?php
function pf_fix_slashes($string){
	if(get_magic_quotes_gpc()==1){
		return($string);
	}else{
		return(addslashes($string));
	}
}
function pf_check_number($value){
	if(isset($value)==FALSE){
		return FALSE;
	}else{
		return TRUE;
	}

}
?>