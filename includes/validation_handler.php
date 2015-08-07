<?php
/**
 * @name Validation Variable Handler
 *
 * @description Success, Info, Warnings, and Errors Section
 *
 * @author Aaron S Thomas <aaron@aaronsthomas.com>
 *
 * @link aaronsthomas.com
 *
 * @version 2.0 This version has been organized and added more session handlers
 *
 * @section Section 1:  Session:: Handlers
 * @section Section 2:  Variable Handlers
 */



/**
 * @section Section 1:  Session:: Hadlers
 *
 * This session will handle the alert for Session::
 *
 * Calls all the set Session::flash() instances
 * form handlers and will display them as:
 * @type {alert-success}      @var $_SESSION['success']
 * @type {alert-success}      @var $_SESSION['home']
 * @type {alert-success}      @var $_SESSION['newsletter']
 * @type {alert-success}      @var $_SESSION['newsletter_sent']
 * @type {alert-success}      @var $_SESSION['logged_in']
 * @type {alert-danger}       @var $_SESSION['danger']
 * @type {alert-danger}       @var $_SESSION['error']
 * @type {alert-info}         @var $_SESSION['info']
 * @type {alert-info}         @var $_SESSION['logged_out']
 * @type {alert-warning}      @var $_SESSION['warning']
 * @type {alert-warning}      @var $_SESSION['info_logged']
 */

    ?>
    <?php if(Session::exists('home') || Session::exists('newsletter') || Session::exists('newsletter_sent') || Session::exists('logged_in') || Session::exists('success')): ?>
        <div id="success" class="alert alert-success" role="alert">
            <?php if(Session::exists('home')): ?>
                <?php echo '<p>'. Session::flash('home'). '</p>'; ?>
            <?php elseif(Session::exists('newsletter')): ?>
                <?php echo '<p>'. Session::flash('newsletter'). '</p>'; ?>
            <?php elseif(Session::exists('newsletter_sent')): ?>
                <?php echo '<p>'. Session::flash('newsletter_sent'). '</p>'; ?>
            <?php elseif(Session::exists('logged_in')): ?>
                <?php echo '<p>'. Session::flash('logged_in'). '</p>'; ?>
            <?php elseif(Session::exists('success')): ?>
                <?php echo '<p>'. Session::flash('success'). '</p>'; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php
    /**
     * This session will handle the alert-danger for Session::
     * @type {danger}   @var $_SESSION['danger']
     * @type {danger}   @var $_SESSION['error']
     */
    ?>
    <?php if(Session::exists('error') || Session::exists('danger')): ?>
        <div id="error-box" class="alert alert-danger" role="alert">
            <?php if(Session::exists('error')): ?>
                <?php echo Session::flash('error'); ?>
            <?php elseif(Session::exists('danger')): ?>
                <?php echo Session::flash('danger'); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>


    <?php
    /**
     * This session will handle the alert-info for Session::
     * @type {alert-info}  @var $_SESSION['info']
     * @type {alert-info}  @var $_SESSION['logged_out']
     */
    ?>
    <?php if(Session::exists('logged_out') || Session::exists('info')): ?>
        <div id="info" class="alert alert-info" role="alert">
            <?php if(Session::exists('logged_out')): ?>
                <?php echo Session::flash('logged_out'); ?>
            <?php elseif(Session::exists('info')): ?>
                <?php echo Session::flash('info'); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php
    /**
     * This session will handle the info-warning for Session::
     * @type {warning}  @var $_SESSION['warning']
     * @type {warning}  @var $_SESSION['info_logged']
     */
    ?>
    <?php if(Session::exists('warning') || Session::exists('info_logged')): ?>
        <div id="warning-box" class="alert alert-warning" role="alert">
            <?php if(Session::exists('warning')): ?>
                <?php echo Session::flash('warning'); ?>
            <?php elseif(Session::exists('info_logged')): ?>
                <?php echo Session::flash('info_logged'); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>



<?php
/**
 * @section Section 2:  Variable Handlers
 *
 * This session will handle the alerts for variables
 *
 * Calls all the form handler variables and
 * will display them as:
 * @type {alert-success}      @var $_SESSION['success']
 * @type {alert-danger}       @var $_SESSION['danger']
 * @type {alert-danger}       @var $_SESSION['error']
 * @type {alert-info}         @var $_SESSION['info']
 * @type {alert-warning}      @var $_SESSION['warning']
 */
?>
    <?php
     if(isset($success)): ?>
    <div id="success" class="alert alert-success" role="alert">
        <?php echo $success; ?>
    </div>
    <?php endif; ?>

    <?php if(isset($info)): ?>
    <div id="info" class="alert alert-info" role="alert">
        <?php echo $info; ?>
    </div>
    <?php endif; ?>

    <?php if(isset($warning)): ?>
    <div id="warning" class="alert alert-warning" role="alert">
        <?php echo $warning; ?>
    </div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
    <div id="error" class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
    <?php endif; ?>

    <?php if(isset($danger)): ?>
    <div id="danger" class="alert alert-danger" role="alert">
        <?php echo $danger; ?>
    </div>
    <?php endif; ?>


<!-- =========================================== -->
<!-- end error and success part and start form   -->
<!-- =========================================== -->