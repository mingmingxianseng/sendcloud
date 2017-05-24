<?php
/**
 * Created by PhpStorm.
 * User: chenmingming
 * Date: 2017/4/7
 * Time: 16:58
 */

namespace sendcloud;

class Mail implements \JsonSerializable
{
    /** @var  string 发件人地址 */
    private $from;
    /**
     * @var string 邮件主题
     */
    private $subject;

    /** @var string 邮件摘要 */
    private $contentSummary;
    /**
     * @var array
     */
    private $attachments;
    /**
     * @var string 邮件头部信息. JSON 格式, 比如:{"header1": "value1", "header2": "value2"}
     */
    private $headers;

    /**
     * @var string 设置用户默认的回复邮件地址.
     * 多个地址使用';'分隔，地址个数不能超过3个. 如果 replyTo 没有或者为空, 则默认的回复邮件地址为 from
     */
    private $replyTo;
    /**
     * @var int 本次发送所使用的标签ID. 此标签需要事先创建
     */
    private $labelId;
    /** @var  string SMTP 扩展字段 */
    private $xSmtpapi;

    /**
     * @var string|true|false 是否返回 emailId. 有多个收件人时, 会返回 emailId 的列表 默认值: true
     */
    private $respEmailId;
    /**
     * @var bool 是否使用地址列表发送.
     */
    private $useAddressList;
    /**
     * @var string  收件人地址. 多个地址使用';'分隔, 如 ben@ifaxin.com;joe@ifaxin.com
     */
    private $to;
    /**
     * @var string 抄送地址 多个地址使用';'分隔,
     */
    private $cc;
    /**
     * @var string 密送地址  多个地址使用';'分隔,
     */
    private $bcc;
    /**
     * @var string 发件人名称.
     */
    private $fromName;
    /**
     * @var bool 是否使用回执 默认false
     */
    private $useNotification;

    /**
     * @var string 邮件的内容. 邮件格式为 text/html
     */
    private $html;

    static private $mustParams = ['from', 'to', 'subject', 'html'];

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     *
     * @return Mail
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return Mail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getContentSummary()
    {
        return $this->contentSummary;
    }

    /**
     * @param string $contentSummary
     *
     * @return Mail
     */
    public function setContentSummary($contentSummary)
    {
        $this->contentSummary = $contentSummary;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     *
     * @return Mail
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $headers
     *
     * @return Mail
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param string $replyTo
     *
     * @return Mail
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * @return int
     */
    public function getLabelId()
    {
        return $this->labelId;
    }

    /**
     * @param int $labelId
     *
     * @return Mail
     */
    public function setLabelId($labelId)
    {
        $this->labelId = $labelId;

        return $this;
    }

    /**
     * @return string
     */
    public function getXSmtpapi()
    {
        return $this->xSmtpapi;
    }

    /**
     * @param string $xSmtpapi
     *
     * @return Mail
     */
    public function setXSmtpapi($xSmtpapi)
    {
        $this->xSmtpapi = $xSmtpapi;

        return $this;
    }

    /**
     * @return false|string|true
     */
    public function getRespEmailId()
    {
        return $this->respEmailId;
    }

    /**
     * @param false|string|true $respEmailId
     *
     * @return Mail
     */
    public function setRespEmailId($respEmailId)
    {
        $this->respEmailId = $respEmailId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUseAddressList()
    {
        return $this->useAddressList;
    }

    /**
     * @param bool $useAddressList
     *
     * @return Mail
     */
    public function setUseAddressList($useAddressList)
    {
        $this->useAddressList = $useAddressList;

        return $this;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $to
     *
     * @return Mail
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param string $cc
     *
     * @return Mail
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * @return string
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param string $bcc
     *
     * @return Mail
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     *
     * @return Mail
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUseNotification()
    {
        return $this->useNotification;
    }

    /**
     * @param bool $useNotification
     *
     * @return Mail
     */
    public function setUseNotification($useNotification)
    {
        $this->useNotification = $useNotification;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html
     *
     * @return Mail
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @desc   addTo
     * @author chenmingming
     *
     * @param string $email 邮件地址
     *
     * @return $this
     */
    public function addTo($email)
    {
        if (!$this->isEmailValid($email)) {
            throw new \InvalidArgumentException("邮件地址不合法");
        }
        if (!is_null($this->to)) {
            $email = ";" . $email;
        }
        $this->to .= $email;

        return $this;
    }

    /**
     * @desc   addCc
     * @author chenmingming
     *
     * @param string $email 邮件地址
     *
     * @return $this
     */
    public function addCc($email)
    {
        if (!$this->isEmailValid($email)) {
            throw new \InvalidArgumentException("邮件地址不合法");
        }
        if (!is_null($this->cc)) {
            $email = ";" . $email;
        }
        $this->cc .= $email;

        return $this;
    }

    /**
     * @desc   addBcc
     * @author chenmingming
     *
     * @param string $email 邮件
     *
     * @return $this
     */
    public function addBcc($email)
    {
        if (!$this->isEmailValid($email)) {
            throw new \InvalidArgumentException("邮件地址不合法");
        }
        if (!is_null($this->bcc)) {
            $email = ";" . $email;
        }
        $this->bcc .= $email;

        return $this;
    }

    private function isEmailValid($email)
    {
        return (bool)preg_match('/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/', $email);
    }

    public function jsonSerialize()
    {
        foreach (self::$mustParams as $param) {
            if (empty($this->$param)) {
                throw new \InvalidArgumentException("param {$param} can not be empty");
            }
        }

        return array_filter([
            'from'        => $this->getFrom(),
            'subject'     => $this->getSubject(),
            'html'        => $this->getHtml(),
            'attachments' => $this->getAttachments(),
            'headers'     => $this->getHeaders(),
            'replyTo'     => $this->getReplyTo(),
            'label'       => $this->getLabelId(),
            'xSmtpapi'    => $this->getXsmtpApi(),
            'respEmailId' => $this->getRespEmailId(),
            'to'          => $this->getTo(),
            'cc'          => $this->getCc(),
            'bcc'         => $this->getBcc(),
            'fromName'    => $this->getFromName(),
        ]);
    }

}