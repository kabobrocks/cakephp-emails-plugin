<?php
    /**
     * Newsletter Templates admin index
     *
     * this is the page for admins to view all the templates in the newsletter
     * plugin.
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://www.dogmatic.co.za
     * @package       blog
     * @subpackage    blog.views.posts.admin_index
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     */
?>
<?php
    echo $this->Letter->adminIndexHead( $this, $paginator );
?>
<div class="table">
    <?php echo $this->Letter->adminTableHeadImages(); ?>
    <?php echo $this->Form->create( 'Post', array( 'url' => array( 'controller' => 'posts', 'action' => 'mass', 'admin' => 'true' ) ) ); ?>
    <table class="listing" cellpadding="0" cellspacing="0">
        <?php
            echo $this->Letter->adminTableHeader(
                array(
                    $this->Form->checkbox( 'all' ) => array(
                        'class' => 'first',
                        'style' => 'width:25px;'
                    ),
                    $paginator->sort( 'name' ),
                    $paginator->sort( 'created' ) => array(
                        'style' => 'width:100px;'
                    ),
                    $paginator->sort( 'modified' ) => array(
                        'style' => 'width:100px;'
                    ),
                    __( 'Status', true ) => array(
                        'class' => 'actions',
                        'width' => '50px'
                    ),
                    __( 'Actions', true ) => array(
                        'class' => 'last actions'
                    )
                )
            );

            foreach( $templates as $template )
            {
                ?>
                    <tr class="<?php echo $this->Letter->rowClass(); ?>">
                        <td><?php echo $this->Form->checkbox( $template['Template']['id'] ); ?>&nbsp;</td>
                        <td><?php echo $this->Html->link( $template['Template']['name'], array( 'action' => 'edit', $template['Template']['id'] ) ); ?>&nbsp;</td>
                        <td><?php echo $this->Time->niceShort( $template['Template']['created'] ); ?>&nbsp;</td>
                        <td><?php echo $this->Time->niceShort( $template['Template']['modified'] ); ?>&nbsp;</td>
                        <td><?php echo $this->Status->locked( $template, 'Template' ); ?>&nbsp;</td>
                        <td>
                            <?php

                                echo $this->Html->link( 'preview', array( 'action' => 'view', $template['Template']['id'] ) ), ' ',
                                $this->Html->link( 'edit', array( 'action' => 'edit', $template['Template']['id'] ) ), ' ',
                                $this->Html->link( 'delete', array( 'action' => 'delete', $template['Template']['id'] ) );
                            ?>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </table>
    <?php
        echo $this->Form->button( __( 'Delete', true ), array( 'value' => 'delete', 'name' => 'delete' ) );
        echo $this->Form->button( __( 'Toggle', true ), array( 'value' => 'toggle' ) );
        echo $this->Form->end();

    ?>
</div>
<?php echo $this->element( 'pagination/navigation' ); ?>