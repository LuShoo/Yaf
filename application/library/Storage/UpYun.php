<?php
/**
 * 存储服务
 *
 * @author octopus <zhangguipo@747.cn>
 * @final 2013-08-15
 */

include "Upyun.class.php";

class Storage_UpYun extends UpYun
{
	/**
	 * @var string
	 */
	private $_host;

	/**
	 * @var string
	 */
	private $_baseDir;

	public function __construct($storage)
	{
             
		//print_r($storage);
		$this->_host=$storage['host'];
		$this->_baseDir= $storage['baseDir'];
		//print_r($storage);
		parent::__construct($storage['zone'], $storage['username'], $storage['password']);
	}

	/**
	 *
	 * @param string $file 文件绝对路径
	 * @param string $filename 文件名
	 * @param string $opts 保存选项
	 * @param boolean $autoMakeDir
	 * @return mixed
	 */
	public function saveImage($file, $filename, $opts = array(), $autoMakeDir = true)
	{
		if(!is_file($file))
		throw new Exception("{$file} not exists!");

		$fileHash = md5_file($file);
		$tail = strtolower(substr(strrchr($filename, "."), 1));
		$newFileName = "{$fileHash}.{$tail}";

		$newFile = $this->getHashFilePath($newFileName);
		$fileHandle = fopen($file, 'rb');
		$writeStatus = $this->writeFile($newFile, $fileHandle, $autoMakeDir, $opts);
		fclose($fileHandle);
		$newFile = "http://{$this->_host}{$newFile}";

		return $newFile;
	}

	/**
	 *
	 * @param string $file 文件绝对路径
	 * @param string $filename dir/文件名
	 * @param string $opts 保存选项
	 * @param boolean $autoMakeDir
	 * @return mixed
	 */
	public function saveCustomImage($file, $filename, $opts = array(), $autoMakeDir = true)
	{
		if(!is_file($file))
		throw new Exception("{$file} not exists!");

		$newFile = $filename;
		$fileHandle = fopen($file, 'rb');
		$writeStatus = $this->writeFile($newFile, $fileHandle, $autoMakeDir, $opts);
		fclose($fileHandle);
		$newFile = "http://{$this->_host}{$newFile}";

		return $newFile;
	}

	/**
	 *
	 * @param string $file 文件绝对路径
	 * @param string $filename 文件名
	 * @param string $opts 保存选项
	 * @param boolean $autoMakeDir
	 * @return mixed
	 */
	public function saveFile($file, $filename, $opts = array(), $autoMakeDir = true)
	{
		if(!is_file($file))
			throw new Exception("{$file} not exists!");
		$newFile = $this->getHashFilePath($filename);
		$fileHandle = fopen($file, 'rb');
		$writeStatus = $this->writeFile($newFile, $fileHandle, $autoMakeDir, $opts);
		fclose($fileHandle);
		$newFile = "http://{$this->_host}{$newFile}";

		return $newFile;
	}
	/**
	 * 获取哈希存储地址
	 *
	 * @param string $fileName
	 * @return string
	 */
	public function getHashFilePath($fileName)
	{
		$dir = $this->hashDir($this->md5Hash($fileName));
		return "{$dir}/{$fileName}";
	}

	/**
	 * 根据字符串计算哈希值
	 *
	 * @param string $str
	 * @return number
	 */
	public function md5Hash($str)
	{
		$hash = md5($str);
		$hash = $hash[0] | ($hash[1] << 8 ) | ($hash[2] << 16) | ($hash[3] << 24) | ($hash[4] << 32) | ($hash[5] << 40) | ($hash[6] << 48) | ($hash[7] << 56);
		return $hash % 701819;
	}

	/**
	 * 根据哈希值生成目录
	 *
	 * @param unknown_type $num
	 * @param unknown_type $file_num
	 * @param unknown_type $m
	 * @return unknown
	 */
	public function hashDir($num, $fileNum = 1000, $m = 3)
	{
		$dir = $this->_baseDir;
		for ($i=1; $i<$m; $i++) {
			$dir .= '/'.round($num / (pow($fileNum, $i)));
		}
		return $dir;
	}

	/**
	 * 获取目录文件列表
	 * 获取目录文件以及子目录列表。需要获取根目录列表是，使用 `$upyun->getList('/')` ，或直接表用方法不传递参数。
	 * 目录获取失败则抛出异常
	 * @param string $path
	 * @return array
	 */
	public function getFileList($path = '/')
	{
		try{
			return $this->getList($path);
		}
		catch(Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
		}
	}
	/**
	 * 创建目录
	 * 目录路径必须以斜杠 `/` 结尾，创建成功返回 `True`，否则抛出异常。
	 * @param string $path
	 * @return array
	 */
	public function makeFileDir($path,$auto_mkdir = TRUE)
	{
		try{
			return $this->makeDir($path,$auto_mkdir);
		}
		catch(Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
		}
	}
	/**
	 * 删除目录或者文件
	 * 删除成功返回True，否则抛出异常。注意删除目录时，`必须保证目录为空` ，否则也会抛出异常。
	 * @param string $path
	 * @return array
	 */
	public function deleteFile($path)
	{
		try{
			return $this->delete($path);
		}
		catch(Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
		}
	}

	/**
	 * 获取文件信息
	 * 返回结果为一个数组。
	 * @param string $filename
	 * @return array
	 */
	public function getFileMsg($filename)
	{
		try{
			return $this->getFileInfo($filename);
		}
		catch(Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
		}
	}

	/**
	 * 获取文件信息
	 * 返回的结果为空间使用量，单位 ***Byte***
	 * @param string $filename
	 * @return array
	 */
	public function getFolderUse($filename='/')
	{
		try{			
			return $this->getFolderUsage($filename);			
		}
		catch(Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
		}
	}
	/**
	 * 下载文件
	 *
	 * @param string $filename
	 * @return array
	 */
	public function getFile($filename, $file_handle = NULL)
	{
		try{
			$fh = fopen($filename, 'w');
			$upyun->readFile($filename, $fh);
			fclose($fh);
		}
		catch(Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
		}
	}
}
