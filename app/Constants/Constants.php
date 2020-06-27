<?php
/**
 * Created by PhpStorm.
 * User: raksha
 * Date: 4/9/18
 * Time: 6:39 PM
 */

namespace App\Constants;

/**
 * Constant values
 * Class Constants
 * @package App\Constants
 */
class Constants
{
    public static $SUCCESS = 'success';

    /**
     * User
     */
    public static $ADMIN_USER = '1';
    public static $SERVICE_CENTER_USER = '2';
    public static $CUSTOMER_USER = '3';

    public static $ACTIVE_MEMBER = '1';
    public static $PAGINATION = 10;

    /**
     * Service Center
     */
    public static $NEW_CENTER = 1;
    public static $APPROVED_CENTER = 2;

    /**
     * Service Request
     */
    public static $UNAPPROVED_REQUEST = 1;
    public static $APPROVED_REQUEST = 2;
    public static $REJECTED_REQUEST = 8;
    public static $PICKED_UP = 5;
    public static $WORKING_ON_IT = 4;
    public static $BILL_GENERATED = 6;
    public static $RETURN_INFORMED = 7;
    public static $CLOSED_REQUEST = 3;

    /**
     * Service Response
     */
    public static $INITIAL_RESPONSE = 1;

    public static $NEW_BILL=1;
    public static $PAYED_BILL=2;

}