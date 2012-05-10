<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Stdlib
 * @subpackage Hydrator
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend\Stdlib\Hydrator;

use Zend\Stdlib\Exception;

/**
 * @category   Zend
 * @package    Zend_Stdlib
 * @subpackage Hydrator
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ArraySerializable implements HydratorInterface
{
    /**
     * Extract values from the provided object
     * 
     * Extracts values via the object's getArrayCopy() method.
     * 
     * @param  object $object 
     * @return array
     * @throws Exception\BadMethodCallException for an $object not implementing getArrayCopy()
     */
    public function extract($object)
    {
        if (!is_callable(array($object, 'getArrayCopy'))) {
            throw new Exception\BadMethodCallException(sprintf(
                '%s expects the provided object to implement getArrayCopy()',
                __METHOD__
            ));
        }
        return $object->getArrayCopy();
    }

    /**
     * Hydrate an object the implements the exchangeArray() method
     *
     * Hydrates an object by passing $data to its exchangeArray() method.
     * 
     * @param  array $data 
     * @param  object $object 
     * @return void
     * @throws Exception\BadMethodCallException for an $object not implementing exchangeArray()
     */
    public function hydrate(array $data, $object)
    {
        if (!is_callable(array($object, 'exchangeArray'))) {
            throw new Exception\BadMethodCallException(sprintf(
                '%s expects the provided object to implement exchangeArray()',
                __METHOD__
            ));
        }
        $object->exchangeArray($data);
    }
}
