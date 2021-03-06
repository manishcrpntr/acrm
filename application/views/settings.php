<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Preferences and Action Center
                </h3>
            </div>
            <div>
                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                    m-dropdown-toggle="hover" aria-expanded="true">
                    <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                        <i class="la la-plus m--hide"></i>
                        <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        <li class="m-nav__section m-nav__section--first m--hide">
                                            <span class="m-nav__section-text">
                                                Common
                                            </span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="javascript:;" data-toggle="modal" data-target="#general_setting_model" class="m-nav__link get_general_settings">
                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                <span class="m-nav__link-text">
                                                    General Settings
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
    </div>

    <!-- END: Subheader -->

    <?php echo '<br>'; ?>
    <div class="m-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    User Role & Permissions Section
                                </h3>
                                <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                                    <span>
                                        User Role
                                    </span>
                                </h2>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                        data-toggle="modal" data-target="#user_role_modal">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </li>
                                <!-- <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="list-group">
                            <?php foreach($user_role as $role){ ?>
                            <li class="list-group-item"> <b>
                                    <?php echo $role;  ?> </b></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Subscription Plans and options
                                </h3>
                                <h2 class="m-portlet__head-label m-portlet__head-label--warning">
                                    <span>
                                        Subscription Plan
                                    </span>
                                </h2>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">

                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="list-group">
                            <?php foreach($subscription_plan as $plans){ ?>
                            <li class="list-group-item"> <b>
                                    <?php echo $plans;  ?> </b></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Unit of Measure
                                </h3>
                                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                                    <span>
                                        UOM
                                    </span>
                                </h2>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;" class="m-portlet__nav-link m-portlet__nav-link--icon get_uom_list"
                                        data-toggle="modal" data-target="#uom_modal">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="list-group">
                            <?php 
                        if(!empty($uom_list)){
                        foreach($uom_list as $uom){ ?>
                            <li class="list-group-item"> <b>
                                    <?php echo $uom;  ?> </b></li>
                            <?php } 
                        } else { ?>
                            <li class="list-group-item"> No UOM Added Yet </b></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="col-lg-4">
                <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Sales Stages & modify probability
                                </h3>
                                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                                    <span>
                                        Sales Stages
                                    </span>
                                </h2>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;" id="fetch_sale_stages" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                        data-toggle="modal" data-target="#sale_Stages_modal">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </li>
                                <!-- <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="list-group">
                            <?php foreach($sales_stages as $sale){ ?>
                            <li class="list-group-item"> <b>
                                    <?php echo $sale;  ?> </b></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Modify Email templates to change overall templates
                                </h3>
                                <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                                    <span>
                                        Email Templates
                                    </span>
                                </h2>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;" id="fetch_email_temples" class="m-portlet__nav-link m-portlet__nav-link--icon fetch_email_temples"
                                        data-toggle="modal" data-target="#email_template_modal">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="list-group">
                            <?php foreach($email_templates as $temple){ ?>
                            <li class="list-group-item"> <b>
                                    <?php echo $temple;  ?> </b></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Targets Duration & options
                                </h3>
                                <h2 class="m-portlet__head-label m-portlet__head-label--warning">
                                    <span>
                                        Targets
                                    </span>
                                </h2>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">

                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="list-group">
                            <?php foreach($target_duration as $duration){ ?>
                            <li class="list-group-item"> <b>
                                    <?php echo $duration;  ?> </b></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uom_modal" tabindex="-1" role="dialog" aria-labelledby="uom_modal_lable" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="add_edit_uom"
                data-parsley-validate action="<?php echo base_url('settings/save_update_uom'); ?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="uom_modal_lable">
                        <b>List of all UOM </b>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 uom_loader" style="display:none">
                        <div class="text-center">
                            <i class="fa 	fa-spinner fa-spin rem-3"></i>
                        </div>
                    </div>
                    <div class="col-sm-12 uom_data_grid">
                        <div class="form-group m-form__group row uom_data_head">
                            <div class="col-lg-2">
                                <b>#</b>
                            </div>
                            <div class="col-lg-4">
                                <b>Code</b>
                            </div>
                            <div class="col-lg-4">
                                <b>Name</b>
                            </div>
                            <div class="col-lg-2">
                                <a href="javascript:;" class="btn btn-info btn-sm add_more_uom"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="service_block_data">
                            <div class="form-group m-form__group row uom_data" data-block="1" data-is_saved="0">
                                <div class="col-lg-2">
                                    <label>
                                        1
                                    </label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" id="uom_input_code_1" required value="" name="uom[1][code]"
                                        class="form-control m-input" placeholder="code">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" id="uom_input_name_1" required name="uom[1][name]" value=""
                                        class="form-control m-input" placeholder="name">
                                </div>
                                <div class="col-lg-2">
                                    <a href="javascript:;" class="btn btn-danger btn-sm remove_current_uom"><i class="fa fa-times"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="update_uom_btn" class="btn btn-primary">
                        <i class="fa fa-check"></i> Update
                    </button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="sale_Stages_modal" tabindex="-1" role="dialog" aria-labelledby="sale_Stages_modal_lable"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="edit_sale_stages"
                data-parsley-validate action="<?php echo base_url('settings/update_sale_stages'); ?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="sale_Stages_modal_lable">
                        <b>Update Sales Stage Probabity</b>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 sale_stages_loader" style="display:none">
                        <div class="text-center">
                            <i class="fa 	fa-spinner fa-spin rem-3"></i>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group m-form__group row sale_stages_data">
                            <div class="col-lg-2">
                                <b>#</b>
                            </div>
                            <div class="col-lg-5">
                                <b>Name</b>
                            </div>
                            <div class="col-lg-5">
                                <b>Probability</b>
                            </div>
                        </div>
                        <?php foreach($all_stages as $key => $stage){  ?>
                        <div class="form-group m-form__group row sale_stages_data">
                            <div class="col-lg-2">
                                <label>
                                    <?php echo $stage['id']; ?>
                                </label>
                            </div>
                            <div class="col-lg-5">
                                <input type="text" readonly id="sale_stages_input_<?php echo $stage['id']; ?>" value="<?php echo $stage['name']; ?>"
                                    name="sale_stage[<?php echo $stage['id']; ?>][name]" class="form-control m-input"
                                    placeholder="name">
                            </div>
                            <div class="col-lg-5">
                                <input type="text" id="sale_stages_input_<?php echo $stage['id']; ?>" value="<?php echo $stage['probability']; ?>"
                                    name="sale_stage[<?php echo $stage['id']; ?>][probability]" class="form-control m-input"
                                    placeholder="10">
                            </div>

                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="update_note_btn" class="btn btn-primary">
                        <i class="fa fa-check"></i> Update
                    </button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="user_role_modal" tabindex="-1" role="dialog" aria-labelledby="user_role_modal_lable"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="edit_sale_stages"
                data-parsley-validate action="<?php echo base_url('settings/update_user_permissions'); ?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="user_role_modal_lable">
                        <b>User Role & Permissions</b>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="update_user_btn" class="btn btn-primary">
                        <i class="fa fa-check"></i> Update
                    </button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="email_template_modal" tabindex="-1" role="dialog" aria-labelledby="email_template_modal_label"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-slg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="email_template_update_form"
                data-parsley-validate action="<?php echo base_url('settings/update_email_template'); ?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="email_template_modal_label">
                        <b>Email Template</b>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-md-12 template_loader" style="display:none">
                        <div class="text-center">
                            <i class="fa 	fa-spinner fa-spin rem-3"></i>
                        </div>
                    </div>
                    <div class="loadded_data_section" style="display:none;">

                        <div class="form-group m-form__group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="email_template_chooser">
                                    Select Template
                                </label>
                                <select required class="form-control m-input" id="email_template_chooser" name="email_template_chooser"></select>
                            </div>
                        </div>

                        <div class="email_template_block" style="display:none;">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="template_subject">
                                        Template Subject
                                    </label>
                                    <input required type="text" id="template_subject" name="template_subject" class="form-control m-input"
                                        placeholder="Enter a subject">
                                </div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-10">
                                <label class="ml-4">
                                    Template Body
                                </label>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="email_editor"></div>
                                </div>
                            </div>

                            <div class="predefined_email_constants_box">
                                <a href="javascript:;" class="btn btn-outline-accent btn-sm m-btn m-btn--icon m-btn--pill email_constants_toggle col-md-3 mb-3 ml-5">Toggle
                                    Email Constants</a>
                                <br>
                                <div class="email_contstans height_150_scroll col-md-12" style="display:none;">
                                    <?php if($email_constants!=""){ ?>
                                    <ul class="list-group">
                                        <?php foreach($email_constants as $key =>  $constants){  ?>
                                        <li class="list-group-item"> <b>
                                                <?php echo $key;  ?> </b> -
                                            <?php echo $constants; ?>
                                        </li>
                                        <?php } ?>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="update_email_template_button" class="btn btn-primary">
                        <i class="fa fa-check"></i> Update
                    </button>

                    <button type="button" class="btn btn-danger close_template_button" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="general_setting_model" tabindex="-1" role="dialog" aria-labelledby="general_setting_model_lable"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="general_setting_form"
                data-parsley-validate action="<?php echo base_url('settings/update_global_settings'); ?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="general_setting_model_lable">
                        <b>General Settings</b>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="general_setting_loader display_none">
                        <div class="col-md-12" >
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin rem-3"></i>
                        </div>
                    </div>
                    </div>
                    <div class="general_setting_block display_none">
                        
                     <div class="form-group m-form__group row">
                            <label class="text-left col-lg-3 col-form-label"> <b>Default Currency</b> </label>
                            <div class="col-lg-9">
                                <input type="text" id="default_currency" name="default_currency" required class="form-control m-input" placeholder="Default Currency ">
                            </div>                             
                    </div>
                    <div class="form-group m-form__group row">
                            <label class="text-left col-lg-3 col-form-label"> <b>Super Admin Email</b> </label>
                            <div class="col-lg-9">
                                <input type="text" id="account_name" name="account_name" required class="form-control m-input" placeholder="Super Admin Email ">
                            </div>                             
                    </div>
                    <div class="form-group m-form__group row">
                            <label class="text-left col-lg-3 col-form-label"> <b>Default Theme</b>  </label>
                            <span class="all_theme_block col-lg-9 row">
                                
                            </span>
                                                         
                    </div>
                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="update_user_btn" class="btn btn-primary">
                        <i class="fa fa-check"></i> Update
                    </button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>