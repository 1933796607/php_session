<?php
class FileHandle implements SessionHandlerInterface
{
    //session保存目录
    protected $path;
    //session过期时间
    protected $maxlifetime;
    public function __construct($path = 'session', $maxlifetime = '1440')
    {
        $this->path = $this->mkdir($path);
        // echo $this->path;
        $this->maxlifetime = $maxlifetime;
    }
    public function close()
    {
        return true;
    }
    public function destroy($id)
    {
        if (is_file($this->path . '/' . $id)) {
            @unlink($this->path . '/' . $id);
        }
        return true;
    }
    public function gc($maxlifetime)
    {
        foreach (glob($this->path . '/*') as $file) {
            if (filemtime($file) + $this->maxlifetime < time()) {
                @unlink($file);
            }
        }
    }
    protected function mkdir($path)
    {
        is_dir($path) or mkdir($path, 0775, true);
        return realpath($path); //函数返回绝对路径
    }
    public function open($path, $name)
    {
        return true;
    }
    public function read($id)
    {
        return (string) @file_get_contents($this->path . '/' . $id);
    }
    public function write($id, $data)
    {
        return @file_put_contents($this->path . '/' . $id, $data);
    }
}
