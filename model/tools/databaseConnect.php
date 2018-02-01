<?php
/**
 * データベース接続情報クラス
 * 
 * データベースへの接続情報を記述するクラス
 * モデルクラスからincludeで使用される
 * 
 * @author NowellGartelt
 * @access public
 * @package model/tools
 * @name databaseConnect
 * @var mysqli $link
 * 
 */

$link = mysqli_connect('localhost','iinchou','meganekko','Okan');
mysqli_set_charset($link, 'utf8');
