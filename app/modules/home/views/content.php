<?php $this->load->view('ui/header') ?>

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="parallax header-stick bottommargin-lg dark" style="padding: 60px 0; background: #616161; height: auto;" data-stellar-background-ratio="0.5">

                    <div class="container clearfix">

                        <div class="col-md-8">
                            <div class="events-calendar">
                                <div class="events-calendar-header clearfix">
                                    <h2>
                                        <span id="calendar-month" class="calendar-month"></span>
                                        <span id="calendar-year" class="calendar-year"></span>
                                    </h2>
                                    <div class="form-inline">
                                        <h3 class="calendar-month-year">
                                            <label for="inputBranch">Select Branch:</label>
                                            <select id="inputBranch" class="form-control leftmargin-xs" name="branches">
                                                <?php foreach ($branches as $key => $branch): ?>
                                                    <option data-address="<?php echo $branch->address ?>" value="<?php echo $branch->id ?>"><?php echo $branch->name; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <nav>
                                                <span id="calendar-prev" class="calendar-prev"><i class="icon-chevron-left"></i></span>
                                                <span id="calendar-next" class="calendar-next"><i class="icon-chevron-right"></i></span>
                                                <span id="calendar-current" class="calendar-current" title="Got to current date"><i class="icon-reload"></i></span>
                                            </nav>
                                        </h3>
                                    </div>
                                </div>
                                <div id="calendar" class="fc-calendar-container"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form id="reservatioForm" class="clear-topmargin-sm">
                                <div class="form-group">
                                    <input type="hidden" name="branch_id" class="form-control">
                                    <input type="hidden" name="date" class="form-control">
                                </div>
                                <div class="form-group inputFields"></div>
                                <div class="form-group inputTimeSlot"></div>
                                <div class="form-group inputSummary"></div>
                                <div class="form-group pull-right inputBook"></div>
                            </form>
                        </div>

                    </div>

                </div>

                <div class="container clearfix">

                    <div class="col_one_fourth nobottommargin">
                        <div class="feature-box fbox-effect fbox-center fbox-outline nobottomborder">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-calendar i-alt"></i></a>
                            </div>
                            <h3>Interactive Sessions<span class="subtitle">Lorem ipsum dolor sit</span></h3>
                        </div>
                    </div>

                    <div class="col_one_fourth nobottommargin">
                        <div class="feature-box fbox-effect fbox-center fbox-outline nobottomborder">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-map i-alt"></i></a>
                            </div>
                            <h3>Great Locations<span class="subtitle">Officia ipsam laudantium</span></h3>
                        </div>
                    </div>

                    <div class="col_one_fourth nobottommargin">
                        <div class="feature-box fbox-effect fbox-center fbox-outline nobottomborder">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-microphone2 i-alt"></i></a>
                            </div>
                            <h3>Global Speakers<span class="subtitle">Laudantium cum dignissimos</span></h3>
                        </div>
                    </div>

                    <div class="col_one_fourth nobottommargin col_last">
                        <div class="feature-box fbox-effect fbox-center fbox-outline nobottomborder">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-food2 i-alt"></i></a>
                            </div>
                            <h3>In-between Meals<span class="subtitle">Perferendis accusantium quae</span></h3>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="divider divider-center"><i class="icon-circle-blank"></i></div>

                    <h3>Upcoming Events</h3>

                    <div id="posts" class="events small-thumbs">

                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="#">
                                    <img src="<?php echo THEME; ?>images/events/thumbs/1.jpg" alt="Inventore voluptates velit totam ipsa tenetur">
                                    <div class="entry-date">10<span>Apr</span></div>
                                </a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2><a href="#">Inventore voluptates velit totam ipsa tenetur</a></h2>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><span class="label label-warning">Private</span></li>
                                    <li><a href="#"><i class="icon-time"></i> 11:00 - 19:00</a></li>
                                    <li><a href="#"><i class="icon-map-marker2"></i> Melbourne, Australia</a></li>
                                </ul>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, voluptatem, dolorem animi nisi autem blanditiis enim culpa reiciendis et explicabo tenetur voluptate rerum molestiae eaque possimus exercitationem eligendi fuga.</p>
                                    <a href="#" class="btn btn-default" disabled="disabled">Buy Tickets</a> <a href="#" class="btn btn-danger">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="#">
                                    <img src="<?php echo THEME; ?>images/events/thumbs/2.jpg" alt="Nemo quaerat nam beatae iusto minima vel">
                                    <div class="entry-date">16<span>Apr</span></div>
                                </a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2><a href="#">Nemo quaerat nam beatae iusto minima vel</a></h2>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><span class="label label-danger">Urgent</span></li>
                                    <li><a href="#"><i class="icon-time"></i> 11:00 - 19:00</a></li>
                                    <li><a href="#"><i class="icon-map-marker2"></i> Perth, Australia</a></li>
                                </ul>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, voluptatem, dolorem animi nisi autem blanditiis enim culpa reiciendis et explicabo tenetur voluptate rerum molestiae eaque possimus exercitationem eligendi fuga.</p>
                                    <a href="#" class="btn btn-info">RSVP</a> <a href="#" class="btn btn-danger">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="#">
                                    <img src="<?php echo THEME; ?>images/events/thumbs/3.jpg" alt="Ducimus ipsam error fugiat harum recusandae">
                                    <div class="entry-date">3<span>May</span></div>
                                </a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2><a href="#">Ducimus ipsam error fugiat harum recusandae</a></h2>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><span class="label label-info">Public</span></li>
                                    <li><a href="#"><i class="icon-time"></i> 11:00 - 19:00</a></li>
                                    <li><a href="#"><i class="icon-map-marker2"></i> Melbourne, Australia</a></li>
                                </ul>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, voluptatem, dolorem animi nisi autem blanditiis enim culpa reiciendis et explicabo tenetur voluptate rerum molestiae eaque possimus exercitationem eligendi fuga.</p>
                                    <a href="#" class="btn btn-default">Buy Tickets</a> <a href="#" class="btn btn-danger">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="#">
                                    <img src="<?php echo THEME; ?>images/events/thumbs/4.jpg" alt="Nisi officia adipisci molestiae aliquam">
                                    <div class="entry-date">16<span>Jun</span></div>
                                </a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2><a href="#">Nisi officia adipisci molestiae aliquam</a></h2>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><span class="label label-warning">Private</span></li>
                                    <li><a href="#"><i class="icon-time"></i> 12:00 - 18:00</a></li>
                                    <li><a href="#"><i class="icon-map-marker2"></i> New York</a></li>
                                </ul>
                                <div class="entry-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, voluptatem, dolorem animi nisi autem blanditiis enim culpa reiciendis et explicabo tenetur voluptate rerum molestiae eaque possimus exercitationem eligendi fuga.</p>
                                    <a href="#" class="btn btn-info">RSVP</a> <a href="#" class="btn btn-danger">Read More</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- #content end -->

        <?php $this->load->view('ui/footer') ?>

        <script type="text/javascript">

            var cal = $( '#calendar' ).calendario( {
                onDayClick : function( $el, $contentEl, dateProperties ) {
                    $('.inputSummary').html('');
                    $('.inputTimeSlot').html('');
                    $('.inputBook').html('');

                    var d = new Date();
                    var today = d.getFullYear()  + "-" + (d.getMonth()+1) + "-" + d.getDate();

                    for( var key in dateProperties ) {
                        var date =  dateProperties.year + '-' +  dateProperties.month + '-' + dateProperties.day;
                    }

                    if(Date.parse(date) >= Date.parse(today)) {
                        $('[name="date"]').val(date);
                        $.ajax({
                            type: 'POST',
                            url: base_url + 'reservation/get_fields_available',
                            data: { date: date, branch_id: $('[name="branch_id"]').val() },
                            dateType: 'JSON',
                            success: function( data ) {
                                var fields = '<label for="inputFields">Fields:</label>' +
                                '<select id="inputFields" class="form-control" name="fields">' +
                                '<option selected disabled>Select Fields</option>';
                                $.each(data.message, function(i, val){
                                    fields += '<option value="' + val.id + '">' + val.fields + '</option>';
                                });
                                fields += '</select>';
                                $('.inputFields').html(fields)
                            },
                            complete: function() {
                                var summary =   '<div class="panel panel-default col_last">' +
                                                    '<div class="panel-heading">' +
                                                        '<h2 class="panel-title">Summary:</h2>' +
                                                    '</div>' +
                                                    '<div class="panel-body">' +
                                                        '<div class="form-group nomargin">' +
                                                            '<label class="width-100">Date: </label>' +
                                                            '<span class="s-date">' + date + '</span>' +
                                                        '</div>' +
                                                        '<div class="form-group nomargin">' +
                                                            '<label class="width-100">Branch: </label>' +
                                                            '<span class="s-branch">' + $('[name="branches"] option:selected').text() + '</span>' +
                                                        '</div>' +
                                                        '<div class="form-group nomargin">' +
                                                            '<label class="width-100">Address: </label>' +
                                                            '<span class="s-address">' + $('[name="branches"] option:selected').data('address') + '</span>' +
                                                        '</div>' +
                                                        '<div class="form-group nomargin">' +
                                                            '<label class="width-100">Fields: </label>' +
                                                            '<span class="s-field"></span>' +
                                                        '</div>' +
                                                        '<div class="form-group nomargin">' +
                                                            '<label class="width-100">Time: </label>' +
                                                            '<span class="s-time"></span>' +
                                                        '</div>' +
                                                        '<div class="form-group nomargin">' +
                                                            '<label>Amount: </label>' +
                                                            '<span class="s-amount pull-right">&#8369; 0</span>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>';
                                   $('.inputSummary').html(summary)
                            }
                        });
                    }

                },
                caldata : canvasEvents,
            } ),
            $month = $( '#calendar-month' ).html( cal.getMonthName() ),
            $year = $( '#calendar-year' ).html( cal.getYear() );

            $( '#calendar-next' ).on( 'click', function() {
                cal.gotoNextMonth( updateMonthYear );
            } );
            $( '#calendar-prev' ).on( 'click', function() {
              if(!containsPastDates()) {
                  cal.gotoPreviousMonth( updateMonthYear );
              }
          } );
            $( '#calendar-current' ).on( 'click', function() {
                cal.gotoNow( updateMonthYear );
            } );

            function containsPastDates() {
                var flag = false;
                $( '#calendar' ).find("span.fc-date").each(function() {
                 if($(this).parent().hasClass('fc-past') && !$(this).parent().hasClass('fc-previous-month')) {
                    flag = true;
                    return false;
                }
            });
                return flag;
            }

            function updateMonthYear() {
                $month.html( cal.getMonthName() );
                $year.html( cal.getYear() );
                getavailableDates();
            };

            $('#calendar').on('shown.calendar.calendario', function(){
                //onDay events to be declared inside 'shown.calendar.calendario'
                //If events : ['click', 'focus'] then only these two events will be
                //available, i.e., 'onDayClick.calendario' and 'onDayFocus.calendario'
                //and so on. You can have custom events.
                $('.dark .fc-calendar .fc-row .fc-future .fc-date').parent().addClass('has-sub');

            });

            $('#inputBranch').on('change', function() {

                $('.inputFields').html('');
                $('.inputSummary').html('');
                $('.inputTimeSlot').html('');
                $('.inputBook').html('');

                getavailableDates();
                $('.s-branch').html($('[name="branches"] option:selected').text());
                $('.s-address').html($('[name="branches"] option:selected').data('address'));
            });

            function getavailableDates() {
                $('[name="branch_id"').val( $('[name="branches"]').val());
                $.ajax({
                    type: 'POST',
                    data: {branch_id:  $('[name="branches"]').val()},
                    url: base_url + 'reservation/get_date_available',
                    dataType: 'JSON',
                    success: function( data ) {

                       var jsObj = {};
                       $.each(data.available_slots, function(key, val) {

                        $.each(val.date, function(q, w) {
                            jsObj[w] = '<span class="label label-default">'+ val.slot[q] +' Available</span>';
                        })
                        console.log(jsObj);
                        
                       });
                       
                        cal.setData(jsObj);

                    }
                });
            }

            $(document).on('change', '#inputFields', function() {
                var id = $(this).val();

                $.ajax({
                    type: 'POST',
                    data: { date: $('[name="date"]').val(), fields: id },
                    url: base_url + 'reservation/get_time_available',
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '<div class="form-group TimeSlotSelected"></div>'
                        '<label for="inputTimeSlot">Time Slot:</label>' +
                        '<ul id="inputTimeSlot" class="list-group">';
                        $.each(data.message, function(i, val){
                            html += '<a id="inputTime" href="javascript:;" data-id="' + val.id + '" data-amount="' + val.amount + '" data-time="' + val.start + ' - ' + val.end + '"><li class="list-group-item">' + val.start + ' - ' + val.end + '</li></a>';
                        });
                        html += '</ul>';
                        $('.inputTimeSlot').html(html)
                    }
                });

                $('.s-field').html($('[name="fields"] option:selected').text());

            });

            $(document).on('click', '#inputTime', function() {
                $('.inputTimeSlot > a').removeAttr('style');
                $(this).css('color', '#fff');
                var id = $(this).data('id');
                var amount = $(this).data('amount');
                var time = $(this).data('time');

                $('.TimeSlotSelected').html('<input type="hidden" value="' + id + '" name="timeslot">');

                $('.s-time').html(time);
                $('.s-amount').html('&#8369; ' + amount);

                $('.inputBook').html('<a id="inputBook" href="#" class="button button-small button-dark button-rounded"><i class="icon-ok"></i>Book</a>')
            });

            $(document).on('click', '#inputBook', function() {
                $.ajax({
                    type: 'POST',
                    data: $('#reservatioForm').serialize(),
                    url: base_url + 'reservation/save',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.login) {
                             window.location.href = base_url + 'login';
                        } else if (data.users) {
                             window.location.href = base_url + 'users';
                        } else {
                            swal({
                              title: "Success!",
                              text: "Check your account for booking information. We'll see you soon!",
                              type: "success",
                              confirmButtonText: "Go to my account",
                              confirmButtonColor: '#444',
                          }, function() {
                            window.location.href = base_url + 'users';
                          });
                        }
                    }
                });
            });

            $(document).on('click', 'div.has-sub', function() {
                $('div.has-sub').removeClass('active');
                $(this).addClass('active');
            });

            $(window).load(function () {
                getavailableDates();
            });

        </script>