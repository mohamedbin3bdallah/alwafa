<!-- footer content -->
        <footer>
          <div class="pull-right">
            <!--Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery --><!-- jQuery -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>gentelella-master/production/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>gentelella-master/production/js/datepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/starrr/dist/starrr.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>gentelella-master/build/js/custom.min.js"></script>

	<script>
	$(document).ready(function(){
		$("#usertype").change(function(){
			var val = $(this).val();
			if(val == 2)
			{
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url(); ?>users/getstores',
					data: {
					},
					success: function (response) { document.getElementById('stores').innerHTML = response; }
				});
			}
			else $("#storesdiv").html('');
		});
	});
	</script>
	
	<script>
		$(document).ready(function(){
			$("#name").focusout(function() {
				var val = $(this).val();
				var id = $('#thisid').val();
				if(!val)
				{
					$("#name").css("background-color", "#F5A9A9");
					$("#name_validation").css("color", "red");
					$("#name_validation").html('الاسم مطلوب');
					$("#name_validation_h").val('0');
					$("#submit").attr('disabled', 'true');
				}
				else
				{
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url(); ?>users/name_validation',
						data: {
							'val':val,
							'id':id
							},
						success: function (response) {
							if(!response)
							{
								$("#name").css("background-color", "#F5A9A9");
								$("#name_validation").css("color", "red");
								$("#name_validation").html('الاسم مطلوب');
								$("#name_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 5)
							{
								$("#name").css("background-color", "#F5A9A9");
								$("#name_validation").css("color", "red");
								$("#name_validation").html('لا تدخل ارقاما');
								$("#name_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 2)
							{
								$("#name").css("background-color", "#F5A9A9");
								$("#name_validation").css("color", "red");
								$("#name_validation").html('الاسم يجب ان يكون اكثر من 5 حروف');
								$("#name_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 3)
							{
								$("#name").css("background-color", "#F5A9A9");
								$("#name_validation").css("color", "red");
								$("#name_validation").html('الاسم يجب ان يكون اقل من 255 حرف');
								$("#name_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 4)
							{
								$("#name").css("background-color", "#F5A9A9");
								$("#name_validation").css("color", "red");
								$("#name_validation").html('الاسم غير متاح');
								$("#name_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 1)
							{
								$("#name").css("background-color", "#81F781");
								$("#name_validation").css("color", "green");
								$("#name_validation").html('الاسم متاح');
								$("#name_validation_h").val('1');
								if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
							}
						}
					});
				}
			});
		});
		
		$(document).ready(function(){
			$("#email").focusout(function() {
				var val = $(this).val();
				var id = $('#thisid').val();
				if(!val)
				{
					$("#email").css("background-color", "#F5A9A9");
					$("#email_validation").css("color", "red");
					$("#email_validation").html('الايميل مطلوب');
					$("#email_validation_h").val('0');
					$("#submit").attr('disabled', 'true');
				}
				else
				{
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url(); ?>users/email_validation',
						data: {
							'val':val,
							'id':id
							},
						success: function (response) {
							if(!response)
							{
								$("#email").css("background-color", "#F5A9A9");
								$("#email_validation").css("color", "red");
								$("#email_validation").html('الايميل مطلوب');
								$("#email_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 2)
							{
								$("#email").css("background-color", "#F5A9A9");
								$("#email_validation").css("color", "red");
								$("#email_validation").html('ادخل ايميلا صحيحا');
								$("#email_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 4)
							{
								$("#email").css("background-color", "#F5A9A9");
								$("#email_validation").css("color", "red");
								$("#email_validation").html('الايميل غير متاح');
								$("#email_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 1)
							{
								$("#email").css("background-color", "#81F781");
								$("#email_validation").css("color", "green");
								$("#email_validation").html('الايميل متاح');
								$("#email_validation_h").val('1');
								if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
							}
						}
					});
				}
			});
		});
		
		$(document).ready(function(){
			$("#password").focusout(function() {
				var val1 = $(this).val();
				var val2 = $('#cnfpassword').val();
				if(!val1 && !val2)
				{
					$("#cnfpassword").css("background-color", "#fff");
					$("#cnfpassword_validation").css("color", "#fff");
					$("#cnfpassword_validation").html('');
					$("#cnfpassword_validation_h").val('1');
					
					$("#password").css("background-color", "#fff");
					$("#password_validation").css("color", "#fff");
					$("#password_validation").html('');
					$("#password_validation_h").val('1');
					
					if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
				}
				else if(!val1 && val2)
				{
					$("#password").css("background-color", "#F5A9A9");
					$("#password_validation").css("color", "red");
					$("#password_validation").html('كلمة المرور مطلوبة');
					$("#password_validation_h").val('0');
					
					$("#cnfpassword").css("background-color", "#F5A9A9");
					$("#cnfpassword_validation").css("color", "red");
					$("#cnfpassword_validation").html('كلمتا المرور غير متطابقتين');
					$("#cnfpassword_validation_h").val('0');
					
					$("#submit").attr('disabled', 'true');
				}
				else
				{
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url(); ?>users/password_validation',
						data: {
							'val1':val1,
							'val2':val2,
							},
						success: function (response) {
							if(!response)
							{
								$("#password").css("background-color", "#F5A9A9");
								$("#password_validation").css("color", "red");
								$("#password_validation").html('كلمة المرور مطلوبة');
								$("#password_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 2)
							{
								$("#password").css("background-color", "#F5A9A9");
								$("#password_validation").css("color", "red");
								$("#password_validation").html('كلمة المرور يجب ان يكون اكثر من 5 حروف');
								$("#password_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 3)
							{
								$("#password").css("background-color", "#F5A9A9");
								$("#password_validation").css("color", "red");
								$("#password_validation").html('كلمة المرور يجب ان يكون اقل من 255 حرف');
								$("#password_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 4)
							{
								$("#cnfpassword").css("background-color", "#F5A9A9");
								$("#cnfpassword_validation").css("color", "red");
								$("#cnfpassword_validation").html('كلمتا المرور غير متطابقتين');
								$("#cnfpassword_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 5)
							{
								$("#password").css("background-color", "#81F781");
								$("#password_validation").css("color", "green");
								$("#password_validation").html('كلمة المرور متاحة');
								$("#password_validation_h").val('1'); 
								$("#cnfpassword").css("background-color", "#81F781");
								$("#cnfpassword_validation").css("color", "green");
								$("#cnfpassword_validation").html('كلمتا المرور متطابقتين');
								$("#cnfpassword_validation_h").val('1');
								if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
							}
							else if(response == 1)
							{
								$("#password").css("background-color", "#81F781");
								$("#password_validation").css("color", "green");
								$("#password_validation").html('كلمة المرور متاحة');
								$("#password_validation_h").val('1'); 
								if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
							}
						}
					});
				}
			});
		});
		
		$(document).ready(function(){
			$("#cnfpassword").focusout(function() {
				var val1 = $(this).val();
				var val2 = $('#password').val();
				if(!val1 && !val2)
				{
					$("#cnfpassword").css("background-color", "#fff");
					$("#cnfpassword_validation").css("color", "#fff");
					$("#cnfpassword_validation").html('');
					$("#cnfpassword_validation_h").val('1');
					
					$("#password").css("background-color", "#fff");
					$("#password_validation").css("color", "#fff");
					$("#password_validation").html('');
					$("#password_validation_h").val('1');
					
					if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
				}
				else if(!val1 && val2)
				{
					$("#cnfpassword").css("background-color", "#F5A9A9");
					$("#cnfpassword_validation").css("color", "red");
					$("#cnfpassword_validation").html('كلمتا المرور غير متطابقتين');
					$("#cnfpassword_validation_h").val('0');
					$("#submit").attr('disabled', 'true');
				}
				else
				{
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url(); ?>users/cnfpassword_validation',
						data: {
							'val1':val1,
							'val2':val2,
							},
						success: function (response) {
							if(!response)
							{
								$("#cnfpassword").css("background-color", "#F5A9A9");
								$("#cnfpassword_validation").css("color", "red");
								$("#cnfpassword_validation").html('تاكيد كلمة المرور مطلوبة');
								$("#cnfpassword_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 4)
							{
								$("#cnfpassword").css("background-color", "#F5A9A9");
								$("#cnfpassword_validation").css("color", "red");
								$("#cnfpassword_validation").html('كلمتا المرور غير متطابقتين');
								$("#cnfpassword_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 1)
							{
								$("#cnfpassword").css("background-color", "#81F781");
								$("#cnfpassword_validation").css("color", "green");
								$("#cnfpassword_validation").html('كلمتا المرور متطابقتين');
								$("#cnfpassword_validation_h").val('1');
								if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
							}
						}
					});
				}
			});
		});
		
		$(document).ready(function(){
			$("#username").focusout(function() {
				var val = $(this).val();
				var id = $('#thisid').val();
				if(!val)
				{
					$("#username").css("background-color", "#F5A9A9");
					$("#username_validation").css("color", "red");
					$("#username_validation").html('اسم المستخدم مطلوب');
					$("#username_validation_h").val('0');
					$("#submit").attr('disabled', 'true');
				}
				else
				{
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url(); ?>users/username_validation',
						data: {
							'val':val,
							'id':id
							},
						success: function (response) {
							if(!response)
							{
								$("#username").css("background-color", "#F5A9A9");
								$("#username_validation").css("color", "red");
								$("#username_validation").html('اسم المستخدم مطلوب');
								$("#username_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 2)
							{
								$("#username").css("background-color", "#F5A9A9");
								$("#username_validation").css("color", "red");
								$("#username_validation").html('اسم المستخدم يجب ان يكون حروفا انجليزية صغيرة');
								$("#username_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 3)
							{
								$("#username").css("background-color", "#F5A9A9");
								$("#username_validation").css("color", "red");
								$("#username_validation").html('يجب ان يكون عدد الحروف اكبر من او يساوي 5');
								$("#username_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 5)
							{
								$("#username").css("background-color", "#F5A9A9");
								$("#username_validation").css("color", "red");
								$("#username_validation").html('عدد الحروف يجب ان يكون اقل من 255');
								$("#username_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 4)
							{
								$("#username").css("background-color", "#F5A9A9");
								$("#username_validation").css("color", "red");
								$("#username_validation").html('الموبايل غير متاح');
								$("#username_validation_h").val('0');
								$("#submit").attr('disabled', 'true');
							}
							else if(response == 1)
							{
								$("#username").css("background-color", "#81F781");
								$("#username_validation").css("color", "green");
								$("#username_validation").html('الموبايل متاح');
								$("#username_validation_h").val('1');
								if($("#name_validation_h").val() == '1' && $("#email_validation_h").val() == '1' && $("#password_validation_h").val() == '1' && $("#cnfpassword_validation_h").val() == '1' && $("#username_validation_h").val() == '1') $("#submit").removeAttr("disabled");
							}
						}
					});
				}
			});
		});
		</script>

<script>
  window.onmousedown = function (e) {
    var el = e.target;
    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
        e.preventDefault();

        // toggle selection
        if (el.hasAttribute('selected')) el.removeAttribute('selected');
        else el.setAttribute('selected', '');

        // hack to correct buggy behavior
        var select = el.parentNode.cloneNode(true);
        el.parentNode.parentNode.replaceChild(select, el.parentNode);
    }
}
</script>

    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- bootstrap-wysiwyg -->
    <script>
      $(document).ready(function() {
        function initToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
              'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
              'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          });
          $('a[title]').tooltip({
            container: 'body'
          });
          $('.dropdown-menu input').click(function() {
              return false;
            })
            .change(function() {
              $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function() {
              this.value = '';
              $(this).change();
            });

          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this),
              target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          });

          if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top,
              left: editorOffset.left + $('#editor').innerWidth() - 35
            });
          } else {
            $('.voiceBtn').hide();
          }
        }

        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        $('#editor').wysiwyg({
          fileUploadError: showErrorAlert
        });

        window.prettyPrint;
        prettyPrint();
      });
    </script>
    <!-- /bootstrap-wysiwyg -->

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select a state",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->

    <!-- jQuery Tags Input -->
    <script>
      function onAddTag(tag) {
        alert("Added a tag: " + tag);
      }

      function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
      }

      function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
      }

      $(document).ready(function() {
        $('#tags_1').tagsInput({
          width: 'auto'
        });
      });
    </script>
    <!-- /jQuery Tags Input -->

    <!-- Parsley -->
    <script>
      $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
          validateFront();
        });
        $('#demo-form .btn').on('click', function() {
          $('#demo-form').parsley().validate();
          validateFront();
        });
        var validateFront = function() {
          if (true === $('#demo-form').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
          } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
          }
        };
      });

      $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
          validateFront();
        });
        $('#demo-form2 .btn').on('click', function() {
          $('#demo-form2').parsley().validate();
          validateFront();
        });
        var validateFront = function() {
          if (true === $('#demo-form2').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
          } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
          }
        };
      });
      try {
        hljs.initHighlightingOnLoad();
      } catch (err) {}
    </script>
    <!-- /Parsley -->

    <!-- Autosize -->
    <script>
      $(document).ready(function() {
        autosize($('.resizable_textarea'));
      });
    </script>
    <!-- /Autosize -->

    <!-- jQuery autocomplete -->
    <script>
      $(document).ready(function() {
        var countries = { AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"Åland Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barthélemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"Côte d’Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"Réunion",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"São Tomé and Príncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region" };

        var countriesArray = $.map(countries, function(value, key) {
          return {
            value: value,
            data: key
          };
        });

        // initialize autocomplete with custom appendTo
        $('#autocomplete-custom-append').autocomplete({
          lookup: countriesArray
        });
      });
    </script>
    <!-- /jQuery autocomplete -->

    <!-- Starrr -->
    <script>
      $(document).ready(function() {
        $(".stars").starrr();

        $('.stars-existing').starrr({
          rating: 4
        });

        $('.stars').on('starrr:change', function (e, value) {
          $('.stars-count').html(value);
        });

        $('.stars-existing').on('starrr:change', function (e, value) {
          $('.stars-count-existing').html(value);
        });
      });
    </script>
    <!-- /Starrr -->
  </body>
</html>
