<?php
/**
 * 
 * @author  Takayuki Kondo <kondoh@rondo.ocn.ne.jp>
 * @create  2014/01/22
 * @copyright 2007 Sunrise Digital Corporation.
 * @version id: v 1.0 2014/01/22 17:31:07 sdkondo Exp
 * 
 **/



class Bd_Acl_Login implements Sdx_Acl_Directory
{
    public function isAllowed(Sdx_Context $context)
    {
        $user = $context->getUser();
        
        return $user->hasId();
    }
}