<div id="content">
    <div id="page">
        <div class="inner">
            <p>&nbsp;</p>
            <div class="section table_section">
                <div class="title_wrapper">
                    <h2>Users List</h2>
                    <span class="title_wrapper_left"></span>
                    <span class="title_wrapper_right"></span>
                </div>
                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">
                                        <form action="#">
                                            <fieldset>
                                                <div class="table_wrapper">
                                                    <div class="table_wrapper_inner">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody><tr>
                                                                    <th>&nbsp;</th>
                                                                    <th>Member ID</th>
                                                                    <th>Member Name</th>
                                                                    <th>Assets Center</th>
                                                                    <th>Assets Unit</th>
                                                                    <th>Login Name</th>
                                                                    <th>Level</th>
                                                                </tr>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($exps as $exp) { ?>																
                                                                    <tr class=<?php
                                                                    if ($i % 2) {
                                                                        echo "first";
                                                                    } else {
                                                                        echo "second";
                                                                    }
                                                                    ?>>
                                                                        <td><?php echo $i; ?></td>
                                                                        <td><?php echo $exp['member_id']; ?></td>
                                                                        <td><?php echo $exp['firstname']; ?></td>
                                                                        <td><?php echo $exp['centreName']; ?></td>
                                                                        <td ><?php echo $exp['place']; ?></td>
                                                                        <td ><?php echo $exp['login']; ?></td>
                                                                        <td ><?php echo $exp['level']; ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php } ?>
                                                            </tbody></table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                </div>
            </div>
            <div class="section table_section">
            </div>
        </div>

    </div>
    <div id="sidebar">
        <div class="inner">
            <p>&nbsp;</p>
            <div class="section">
                <div class="title_wrapper">
                    <h2>
                        Asset Management
                    </h2>
                    <span class="title_wrapper_left"></span>
                    <span class="title_wrapper_right"></span>
                </div>
                <!--[if !IE]>end title wrapper<![endif]-->
                <!--[if !IE]>start section content<![endif]-->
                <div class="section_content">
                    <!--[if !IE]>start section content top<![endif]-->
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">
                                        <div class="photo_gallery">
                                            <div class="gal_top">
                                                <div class="gal_bottom">
                                                    <div class="gal_left">
                                                        <div class="gal_right">
                                                            <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                    <div class="section_content_footer">

                        <span class="scf"></span>
                    </div>
                    <!--[if !IE]>end section content footer<![endif]-->


                </div>
                <!--[if !IE]>end section content<![endif]-->
            </div>
            <!--[if !IE]>end section<![endif]-->


            <!--[if !IE]>start quick info<![endif]-->
            <div class="quick_info">
                <div class="quick_info_top">
                    <h2>Quick info</h2>
                </div>
                <div class="quick_info_content">
                    <!-- webim button --><a href="/webim/client.php?locale=en&amp;style=original" target="_blank" onclick="if (navigator.userAgent.toLowerCase().indexOf('opera') != - 1 & amp; & amp; window.event.preventDefault) window.event.preventDefault(); this.newWindow = window.open('/webim/client.php?locale=en&amp;style=original&amp;url=' + escape(document.location.href) + '&amp;referrer=' + escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1'); this.newWindow.focus(); this.newWindow.opener = window; return false;"><img src="/webim/b.php?i=simple&amp;lang=en" border="0" width="200" height="55" alt=""/></a><!-- / webim button -->
                    <!--
                    Skype 'Skype Me�!' button
                    http://www.skype.com/go/skypebuttons
                    -->
                    <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
                    <a href="skype:grip113a?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_blue_white_124x52.png" style="border: none;" width="124" height="52" alt="Skype Me�!" /></a>
                </div>
                <span class="quick_info_bottom"></span>
            </div>
            <!--[if !IE]>end quick info<![endif]-->




        </div>
    </div>