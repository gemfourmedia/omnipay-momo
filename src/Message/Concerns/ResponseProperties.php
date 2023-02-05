<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

 namespace Omnipay\MoMo\Message\Concerns;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
trait ResponseProperties
{
    /**
     *
     * @param  string  $name
     * @return null|string
     */
    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            trigger_error(sprintf('Undefined property: %s::%s', __CLASS__, '$'.$name), E_USER_NOTICE);

            return;
        }
    }

    /**
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return null|string
     */
    public function __set($name, $value)
    {
        if (isset($this->data[$name])) {
            trigger_error(sprintf('Undefined property: %s::%s', __CLASS__, '$'.$name), E_USER_NOTICE);
        } else {
            $this->$name = $value;
        }
    }
}
