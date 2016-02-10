<?php
  $image=$args[1];
?>
<div class="frame" style="background-image:url(<?php echo $image?>)">
  
  <div class="box">
    <div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active col-xs-6">
          <a href="#prepaid" aria-controls="prepaid" role="tab" data-toggle="tab">
            Prepaid
          </a>
        </li>
        <li role="presentation" class="col-xs-6">
          <a href="#postpaid" aria-controls="postpaid" role="tab" data-toggle="tab">
            Postpaid
          </a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="prepaid">
            <div class="info">Short login instructions for prepaid users.</div>
            <div class="form">
              <!-- ************** BEGIN GRAVITY FORM  ************-->
              <div class="gf_browser_chrome gform_wrapper" id="gform_wrapper_1"><a id="gf_1" class="gform_anchor"></a>
              <form method="post" enctype="multipart/form-data" target="gform_ajax_frame_1" id="gform_1" action="/#gf_1">
              <div class="gform_body">
                <ul id="gform_fields_1" class="gform_fields top_label form_sublabel_below description_below">
                  <li id="field_1_2" class="gfield form-field gfield_contains_required field_sublabel_below field_description_below">
                    
                    <div class="ginput_container ginput_container_text">
                      <input name="input_2" id="input_1_2" type="text" value="" class="large" tabindex="49" placeholder="USER NAME"></div>
                  </li>
                </ul>
              </div>
              <div class="gform_footer top_label"> 
                <input type="submit" id="gform_submit_button_1" class="gform_button button" value="LOGIN" tabindex="54" onclick="if(window[&quot;gf_submitting_1&quot;]){return false;}  window[&quot;gf_submitting_1&quot;]=true;  "> 
              </div>
              </form>
              </div>
              <!-- ************** END GRAVITY FORM  ************-->
            </div>
            <div class="info">Request an ID</div>
        </div>
  
        <div role="tabpanel" class="tab-pane" id="postpaid">
          ...
        </div>
  
      </div>
      <div class="download">
        <span class="info">Download more info about prepaid & postpaid service</span>
        <i class="icon-document"></i>
        
      </div>
      
</div>
</div>
</div>