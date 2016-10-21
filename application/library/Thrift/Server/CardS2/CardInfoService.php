<?php
namespace Thrift\Server\CardS2;
/**
 * Autogenerated by Thrift Compiler (0.9.2)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


interface CardInfoServiceIf {
  /**
   * @param \Thrift\Server\CardS2\CardInfo[] $CardInfos
   * @return string
   * @throws \Thrift\Server\CardS2\SaveOrUpdateException
   */
  public function addCardInfos(array $CardInfos);
  /**
   * @param \Thrift\Server\CardS2\CardInfo[] $CardInfos
   * @return string
   * @throws \Thrift\Server\CardS2\SaveOrUpdateException
   */
  public function updateCardInfos(array $CardInfos);
  /**
   * @param int $type_id
   * @param string $batch
   * @param string $iccid
   * @param string $telephone
   * @param int $status
   * @param int $page
   * @param int $size
   * @param string $beginTime
   * @param string $endTime
   * @return \Thrift\Server\CardS2\PageCardInfos
   * @throws \Thrift\Server\CardS2\DataNotFoundException
   */
  public function queryCardInfos($type_id, $batch, $iccid, $telephone, $status, $page, $size, $beginTime, $endTime);
  /**
   * @param int $id
   * @param string $iccid
   * @param string $telephone
   * @return \Thrift\Server\CardS2\CardInfo[]
   * @throws \Thrift\Server\CardS2\DataNotFoundException
   */
  public function queryCardInfo($id, $iccid, $telephone);
}

class CardInfoService implements \Thrift\Server\CardS2\CardInfoServiceIf {
  protected $input_ = null;
  protected $output_ = null;

  protected $seqid_ = 0;

  public function __construct($input, $output=null) {
    $this->input_ = $input;
    $this->output_ = $output ? $output : $input;
  }

  public function addCardInfos(array $CardInfos)
  {
    $this->send_addCardInfos($CardInfos);
    return $this->recv_addCardInfos();
  }

  public function send_addCardInfos(array $CardInfos)
  {
    $args = new \Thrift\Server\CardS2\CardInfoService_addCardInfos_args();
    $args->CardInfos = $CardInfos;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'addCardInfos', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('addCardInfos', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_addCardInfos()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\Thrift\Server\CardS2\CardInfoService_addCardInfos_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \Thrift\Server\CardS2\CardInfoService_addCardInfos_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->e !== null) {
      throw $result->e;
    }
    throw new \Exception("addCardInfos failed: unknown result");
  }

  public function updateCardInfos(array $CardInfos)
  {
    $this->send_updateCardInfos($CardInfos);
    return $this->recv_updateCardInfos();
  }

  public function send_updateCardInfos(array $CardInfos)
  {
    $args = new \Thrift\Server\CardS2\CardInfoService_updateCardInfos_args();
    $args->CardInfos = $CardInfos;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'updateCardInfos', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('updateCardInfos', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_updateCardInfos()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\Thrift\Server\CardS2\CardInfoService_updateCardInfos_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \Thrift\Server\CardS2\CardInfoService_updateCardInfos_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->e !== null) {
      throw $result->e;
    }
    throw new \Exception("updateCardInfos failed: unknown result");
  }

  public function queryCardInfos($type_id, $batch, $iccid, $telephone, $status, $page, $size, $beginTime, $endTime)
  {
    $this->send_queryCardInfos($type_id, $batch, $iccid, $telephone, $status, $page, $size, $beginTime, $endTime);
    return $this->recv_queryCardInfos();
  }

  public function send_queryCardInfos($type_id, $batch, $iccid, $telephone, $status, $page, $size, $beginTime, $endTime)
  {
    $args = new \Thrift\Server\CardS2\CardInfoService_queryCardInfos_args();
    $args->type_id = $type_id;
    $args->batch = $batch;
    $args->iccid = $iccid;
    $args->telephone = $telephone;
    $args->status = $status;
    $args->page = $page;
    $args->size = $size;
    $args->beginTime = $beginTime;
    $args->endTime = $endTime;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'queryCardInfos', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('queryCardInfos', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_queryCardInfos()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\Thrift\Server\CardS2\CardInfoService_queryCardInfos_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \Thrift\Server\CardS2\CardInfoService_queryCardInfos_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->dataNotFound !== null) {
      throw $result->dataNotFound;
    }
    throw new \Exception("queryCardInfos failed: unknown result");
  }

  public function queryCardInfo($id, $iccid, $telephone)
  {
    $this->send_queryCardInfo($id, $iccid, $telephone);
    return $this->recv_queryCardInfo();
  }

  public function send_queryCardInfo($id, $iccid, $telephone)
  {
    $args = new \Thrift\Server\CardS2\CardInfoService_queryCardInfo_args();
    $args->id = $id;
    $args->iccid = $iccid;
    $args->telephone = $telephone;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'queryCardInfo', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('queryCardInfo', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_queryCardInfo()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\Thrift\Server\CardS2\CardInfoService_queryCardInfo_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \Thrift\Server\CardS2\CardInfoService_queryCardInfo_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->dataNotFound !== null) {
      throw $result->dataNotFound;
    }
    throw new \Exception("queryCardInfo failed: unknown result");
  }

}

// HELPER FUNCTIONS AND STRUCTURES

class CardInfoService_addCardInfos_args {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\CardS2\CardInfo[]
   */
  public $CardInfos = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'CardInfos',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\CardS2\CardInfo',
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['CardInfos'])) {
        $this->CardInfos = $vals['CardInfos'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_addCardInfos_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::LST) {
            $this->CardInfos = array();
            $_size21 = 0;
            $_etype24 = 0;
            $xfer += $input->readListBegin($_etype24, $_size21);
            for ($_i25 = 0; $_i25 < $_size21; ++$_i25)
            {
              $elem26 = null;
              $elem26 = new \Thrift\Server\CardS2\CardInfo();
              $xfer += $elem26->read($input);
              $this->CardInfos []= $elem26;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_addCardInfos_args');
    if ($this->CardInfos !== null) {
      if (!is_array($this->CardInfos)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('CardInfos', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRUCT, count($this->CardInfos));
        {
          foreach ($this->CardInfos as $iter27)
          {
            $iter27 = new \Thrift\Server\CardS2\CardInfo($iter27);
            $xfer += $iter27->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class CardInfoService_addCardInfos_result {
  static $_TSPEC;

  /**
   * @var string
   */
  public $success = null;
  /**
   * @var \Thrift\Server\CardS2\SaveOrUpdateException
   */
  public $e = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        1 => array(
          'var' => 'e',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\CardS2\SaveOrUpdateException',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
      if (isset($vals['e'])) {
        $this->e = $vals['e'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_addCardInfos_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 0:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->e = new \Thrift\Server\CardS2\SaveOrUpdateException();
            $xfer += $this->e->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_addCardInfos_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->e !== null) {
      $xfer += $output->writeFieldBegin('e', TType::STRUCT, 1);
      $xfer += $this->e->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class CardInfoService_updateCardInfos_args {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\CardS2\CardInfo[]
   */
  public $CardInfos = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'CardInfos',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\CardS2\CardInfo',
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['CardInfos'])) {
        $this->CardInfos = $vals['CardInfos'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_updateCardInfos_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::LST) {
            $this->CardInfos = array();
            $_size28 = 0;
            $_etype31 = 0;
            $xfer += $input->readListBegin($_etype31, $_size28);
            for ($_i32 = 0; $_i32 < $_size28; ++$_i32)
            {
              $elem33 = null;
              $elem33 = new \Thrift\Server\CardS2\CardInfo();
              $xfer += $elem33->read($input);
              $this->CardInfos []= $elem33;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_updateCardInfos_args');
    if ($this->CardInfos !== null) {
      if (!is_array($this->CardInfos)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('CardInfos', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRUCT, count($this->CardInfos));
        {
          foreach ($this->CardInfos as $iter34)
          {
            $iter34 = new \Thrift\Server\CardS2\CardInfo($iter34);
            $xfer += $iter34->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class CardInfoService_updateCardInfos_result {
  static $_TSPEC;

  /**
   * @var string
   */
  public $success = null;
  /**
   * @var \Thrift\Server\CardS2\SaveOrUpdateException
   */
  public $e = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        1 => array(
          'var' => 'e',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\CardS2\SaveOrUpdateException',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
      if (isset($vals['e'])) {
        $this->e = $vals['e'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_updateCardInfos_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 0:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->e = new \Thrift\Server\CardS2\SaveOrUpdateException();
            $xfer += $this->e->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_updateCardInfos_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->e !== null) {
      $xfer += $output->writeFieldBegin('e', TType::STRUCT, 1);
      $xfer += $this->e->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class CardInfoService_queryCardInfos_args {
  static $_TSPEC;

  /**
   * @var int
   */
  public $type_id = null;
  /**
   * @var string
   */
  public $batch = null;
  /**
   * @var string
   */
  public $iccid = null;
  /**
   * @var string
   */
  public $telephone = null;
  /**
   * @var int
   */
  public $status = null;
  /**
   * @var int
   */
  public $page = null;
  /**
   * @var int
   */
  public $size = null;
  /**
   * @var string
   */
  public $beginTime = null;
  /**
   * @var string
   */
  public $endTime = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'type_id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'batch',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'iccid',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'telephone',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'status',
          'type' => TType::I32,
          ),
        6 => array(
          'var' => 'page',
          'type' => TType::I32,
          ),
        7 => array(
          'var' => 'size',
          'type' => TType::I32,
          ),
        8 => array(
          'var' => 'beginTime',
          'type' => TType::STRING,
          ),
        9 => array(
          'var' => 'endTime',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['type_id'])) {
        $this->type_id = $vals['type_id'];
      }
      if (isset($vals['batch'])) {
        $this->batch = $vals['batch'];
      }
      if (isset($vals['iccid'])) {
        $this->iccid = $vals['iccid'];
      }
      if (isset($vals['telephone'])) {
        $this->telephone = $vals['telephone'];
      }
      if (isset($vals['status'])) {
        $this->status = $vals['status'];
      }
      if (isset($vals['page'])) {
        $this->page = $vals['page'];
      }
      if (isset($vals['size'])) {
        $this->size = $vals['size'];
      }
      if (isset($vals['beginTime'])) {
        $this->beginTime = $vals['beginTime'];
      }
      if (isset($vals['endTime'])) {
        $this->endTime = $vals['endTime'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_queryCardInfos_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->type_id);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->batch);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->iccid);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->telephone);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->status);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->page);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->size);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->beginTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->endTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_queryCardInfos_args');
    if ($this->type_id !== null) {
      $xfer += $output->writeFieldBegin('type_id', TType::I32, 1);
      $xfer += $output->writeI32($this->type_id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->batch !== null) {
      $xfer += $output->writeFieldBegin('batch', TType::STRING, 2);
      $xfer += $output->writeString($this->batch);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->iccid !== null) {
      $xfer += $output->writeFieldBegin('iccid', TType::STRING, 3);
      $xfer += $output->writeString($this->iccid);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->telephone !== null) {
      $xfer += $output->writeFieldBegin('telephone', TType::STRING, 4);
      $xfer += $output->writeString($this->telephone);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->status !== null) {
      $xfer += $output->writeFieldBegin('status', TType::I32, 5);
      $xfer += $output->writeI32($this->status);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->page !== null) {
      $xfer += $output->writeFieldBegin('page', TType::I32, 6);
      $xfer += $output->writeI32($this->page);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->size !== null) {
      $xfer += $output->writeFieldBegin('size', TType::I32, 7);
      $xfer += $output->writeI32($this->size);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->beginTime !== null) {
      $xfer += $output->writeFieldBegin('beginTime', TType::STRING, 8);
      $xfer += $output->writeString($this->beginTime);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->endTime !== null) {
      $xfer += $output->writeFieldBegin('endTime', TType::STRING, 9);
      $xfer += $output->writeString($this->endTime);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class CardInfoService_queryCardInfos_result {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\CardS2\PageCardInfos
   */
  public $success = null;
  /**
   * @var \Thrift\Server\CardS2\DataNotFoundException
   */
  public $dataNotFound = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\CardS2\PageCardInfos',
          ),
        1 => array(
          'var' => 'dataNotFound',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\CardS2\DataNotFoundException',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
      if (isset($vals['dataNotFound'])) {
        $this->dataNotFound = $vals['dataNotFound'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_queryCardInfos_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 0:
          if ($ftype == TType::STRUCT) {
            $this->success = new \Thrift\Server\CardS2\PageCardInfos();
            $xfer += $this->success->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->dataNotFound = new \Thrift\Server\CardS2\DataNotFoundException();
            $xfer += $this->dataNotFound->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_queryCardInfos_result');
    if ($this->success !== null) {
      if (!is_object($this->success)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('success', TType::STRUCT, 0);
      $xfer += $this->success->write($output);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->dataNotFound !== null) {
      $xfer += $output->writeFieldBegin('dataNotFound', TType::STRUCT, 1);
      $xfer += $this->dataNotFound->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class CardInfoService_queryCardInfo_args {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = null;
  /**
   * @var string
   */
  public $iccid = null;
  /**
   * @var string
   */
  public $telephone = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'iccid',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'telephone',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['iccid'])) {
        $this->iccid = $vals['iccid'];
      }
      if (isset($vals['telephone'])) {
        $this->telephone = $vals['telephone'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_queryCardInfo_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->id);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->iccid);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->telephone);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_queryCardInfo_args');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I32, 1);
      $xfer += $output->writeI32($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->iccid !== null) {
      $xfer += $output->writeFieldBegin('iccid', TType::STRING, 2);
      $xfer += $output->writeString($this->iccid);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->telephone !== null) {
      $xfer += $output->writeFieldBegin('telephone', TType::STRING, 3);
      $xfer += $output->writeString($this->telephone);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class CardInfoService_queryCardInfo_result {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\CardS2\CardInfo[]
   */
  public $success = null;
  /**
   * @var \Thrift\Server\CardS2\DataNotFoundException
   */
  public $dataNotFound = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\CardS2\CardInfo',
            ),
          ),
        1 => array(
          'var' => 'dataNotFound',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\CardS2\DataNotFoundException',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
      if (isset($vals['dataNotFound'])) {
        $this->dataNotFound = $vals['dataNotFound'];
      }
    }
  }

  public function getName() {
    return 'CardInfoService_queryCardInfo_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 0:
          if ($ftype == TType::LST) {
            $this->success = array();
            $_size35 = 0;
            $_etype38 = 0;
            $xfer += $input->readListBegin($_etype38, $_size35);
            for ($_i39 = 0; $_i39 < $_size35; ++$_i39)
            {
              $elem40 = null;
              $elem40 = new \Thrift\Server\CardS2\CardInfo();
              $xfer += $elem40->read($input);
              $this->success []= $elem40;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->dataNotFound = new \Thrift\Server\CardS2\DataNotFoundException();
            $xfer += $this->dataNotFound->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('CardInfoService_queryCardInfo_result');
    if ($this->success !== null) {
      if (!is_array($this->success)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('success', TType::LST, 0);
      {
        $output->writeListBegin(TType::STRUCT, count($this->success));
        {
          foreach ($this->success as $iter41)
          {
            $xfer += $iter41->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->dataNotFound !== null) {
      $xfer += $output->writeFieldBegin('dataNotFound', TType::STRUCT, 1);
      $xfer += $this->dataNotFound->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

