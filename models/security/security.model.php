<?php

require_once "libs/dao.php" ;

function obtainUserByEmail($userEmail){
   $usuario = array();
   $sqlStr = "SELECT `userCod`,`userEmail`, `userName`, `userPswd`,
   UNIX_TIMESTAMP(`userRgstrd`) as userRgstrd, `userPswdState`, `userPswdExp`,
   `userState`, `userVrfd`, `userPswdChg`,`userCell`
   FROM user where userEmail = '%s';";
   $usuario = obtenerUnRegistro(sprintf($sqlStr,$userEmail));
   return $usuario;
}
function userExists($mail){
   $sqlStr = "SELECT COUNT(*) as `exists` FROM `user` where userEmail = '%s';";
   $result = obtenerUnRegistro(sprintf($sqlStr,$mail));
   return $result["exists"];
}
function getUserByFilter($userEmail){
   $usuario = array();
   $sqlStr = "SELECT `userCod`,`userEmail`, `userName`,
   `userState`, `userCell`
   FROM user  where userEmail like '%s';";

   $usuarios = obtenerRegistros(sprintf($sqlStr,$userEmail.'%'));
   return $usuarios;
}

function getUserByCode($usercod){
   $usuario = array();
   $sqlStr = sprintf("SELECT `userCod`,`userEmail`, `userName`,`userPswd`,
     UNIX_TIMESTAMP(`userRgstrd`) as userRgstrd,`userState`,`userCell`
      FROM user where userCod = %d;",intval($usercod));
   $usuario = obtenerUnRegistro($sqlStr);
   return $usuario;
}

function authorized($userEmail, $assetcod){
  $data = array();  
  $sqlStr = "select u.userState from user u 
            inner join `user_type` ut on u.userCod = ut.userCodUT
            inner join `type` t on ut.typeCodUT = t.typeCod
            inner join type_module tm on t.typeCod = tm.typeCod
            where binary u.userEmail = '%s' and tm.mdlCod = '%s';";
    $data = obtenerUnRegistro(sprintf($sqlStr,$userEmail,valstr($assetcod)));
    if(!empty($data)){
        return true;
    }
    return false;
}
function makeMenu($userEmail){
   $menu = array();
   $sqlStr=" select m.mdlCod,m.mdlDscES FROM `user` u 
               inner join `user_type` ut on u.userCod = ut.userCodUT
               inner join `type` t on ut.typeCodUT = t.typeCod
               inner join `type_module` tm on tm.typeCod = t.typeCod
               inner join `module` m on m.mdlCod = tm.mdlCod
               where m.mdlClass = 'MNU' and m.mdlState = 'ACT' and u.userEmail = '%s'
               order by m.mdlDscES;";
      $menu = obtenerRegistros(sprintf($sqlStr, $userEmail));
   return $menu;
}
function newUser($userEmail, $userName,  $userPswd, $timestamp,$userCell='', $userState ='ACT',$userPswdState='ACT' ){
   
   $pwsdChangeTime= $timestamp;

   $strsql = "INSERT INTO `user` 
   (`userEmail`, `userName`, `userPswd`,`userRgstrd`, `userPswdState`, `userPswdExp`,`userState`, `userVrfd`, `userCell`)
   VALUES ('%s','%s','%s',FROM_UNIXTIME(%s),'%s',DATE_ADD(FROM_UNIXTIME(%s),INTERVAL 1 YEAR),'%s',false,'%s');";
   $strsql = sprintf($strsql, 
                    valstr($userEmail),
                    valstr($userName),
                    $userPswd,
                    $timestamp,
                    $userPswdState,
                    $pwsdChangeTime,
                    valstr($userState),
                    $userCell);
   if(ejecutarNonQuery($strsql)){
       return getLastInserId();
   }
   return 0;
}
function updateUser($userCod,$userEmail, $userName,  $userPswd, $timestamp,$userCell=' ', $userState ='ACT',$userPswdState='ACT' ){

   $pwsdChangeTime= $timestamp;

   $strsql = "UPDATE `user` set `userEmail`='%s', `userName`='%s', `userPswd`='%s',`userRgstrd`=FROM_UNIXTIME(%s), 
                           `userPswdState`='%s', `userPswdExp`= DATE_ADD(FROM_UNIXTIME(%s),INTERVAL 1 YEAR),`userState`='%s', `userCell`='%s',
                           `userLM` = now() where `userCod` = %d;";
   $strsql = sprintf($strsql, 
                    valstr($userEmail),
                    valstr($userName),
                    $userPswd,
                    $timestamp,
                    $userPswdState,
                    $pwsdChangeTime,
                    valstr($userState),
                    $userCell,
                    intval($userCod));
   $affected = ejecutarNonQuery($strsql);
   return ($affected > 0);
}
function addRole($typeCod,$userCod,$userTypeState = 'ACT', $userTypeExp='NULL'){
   $sqlIns = "INSERT INTO `user_type`(`typeCodUT`, `userCodUT`, `userTypeState`,`userTypeExp`,`userTypeRgstrd`)
   VALUES('%s',%d,'%s',%s,now());";
   $sqlIns = sprintf($sqlIns,$typeCod, intval($userCod), $userTypeState, $userTypeExp);
   $affected = ejecutarNonQuery($sqlIns);
   return ($affected > 0);

}
function removeRole($typeCod,$userCod){
   $sqlDel = "DELETE FROM `user_type` ut WHERE ut.userCodUT = %d and ut.typeCodUT = '%s'; ";
   $result = ejecutarNonQuery(sprintf($sqlDel, intval($userCod), $typeCod));
    if($result)
        return TRUE;
    else
        return FALSE;
}
function userRoles($userCod){
   $sqlStr ="SELECT t.typeCod,t.typeDsc,ut.userCodUT from `type` t 
            left join `user_type` ut on t.typeCod = ut.typeCodUT
            where ut.userCodUT = %d and t.typeState = 'ACT';";
   $roles = array();
   $roles = obtenerRegistros(sprintf($sqlStr, intval($userCod)));
   return $roles;
}
function userAvalaibleRoles($userCod){
   $sqlStr ="SELECT t.typeCod, t.typeDsc from `type` t 
            left join `user_type` ut on t.typeCod = ut.typeCodUT and ut.userCodUT = '%d'
            where ut.userCodUT is null and t.typeState = 'ACT' ;";
   $roles = array();
   $roles = obtenerRegistros(sprintf($sqlStr, intval($userCod)));
   return $roles;
}
function updateUserNameCell($userName,$userCell,$userCod){
   $sqlStr = "UPDATE  `user` set `userName` = '%s' ,`userCell` = '%s' where `userCod` = %d ; ";
   $result = ejecutarNonQuery(sprintf($sqlStr,$userName,$userCell,$userCod));
   return ($result > 0);
}
function updatePassword($userCod, $userPswd,$userRgstrd){
   $sqlUpd = "UPDATE `user` set `userPswd` = '%s' , `userRgstrd` = FROM_UNIXTIME(%s) where `userCod` = %d ;";
   $result = ejecutarNonQuery(sprintf($sqlUpd,$userPswd, $userRgstrd,$userCod));
   return ($result > 0);   
}
function updatePasswordByMail($userEmail, $userPswd,$userRgstrd){
   $sqlUpd = "UPDATE `user` set `userPswd` = '%s' , `userRgstrd` = FROM_UNIXTIME(%s) where `userEmail` = '%s' ;";
   $result = ejecutarNonQuery(sprintf($sqlUpd,$userPswd, $userRgstrd,$userEmail));
   return ($result > 0);   
}
function userToken($userEmail){
   $sqlStr = "SELECT `userPswdChg`
   FROM user where userEmail = '%s';";
   $usuario = obtenerUnRegistro(sprintf($sqlStr,$userEmail));
   return $usuario["userPswdChg"];  
}

function forgotPassword($userEmail,$token){
   $sqlUpd = "UPDATE `user` set `userPswdChg` = '%s' where `userEmail` = '%s'; ";
   $result = ejecutarNonQuery(sprintf($sqlUpd,$token,$userEmail));
   return ($result > 0);  
}
?>
