<%@ Page Language="C#" AutoEventWireup="true"  CodeFile="Home.aspx.cs" Inherits="_Default" %>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<%--<script type="text/javascript">

    /******************************************
    * Snow Effect Script- By Altan d.o.o. (http://www.altan.hr/snow/index.html)
    * Visit Dynamic Drive DHTML code library (http://www.dynamicdrive.com/) for full source code
    * Last updated Nov 9th, 05' by DD. This notice must stay intact for use
    ******************************************/

    //Configure below to change URL path to the snow image
    var snowsrc = "http://bgcacdcp.org/images/snow3.gif"
    var snowarr = ["http://bgcacdcp.org/images/snow.gif", "http://bgcacdcp.org/images/snow2.gif", "http://bgcacdcp.org/images/snow3.gif"];
    // Configure below to change number of snow to render
    var no = 50;
    var count = 0;
    // Configure whether snow should disappear after x seconds (0=never):
    var hidesnowtime = 5000;
    // Configure how much snow should drop down before fading ("windowheight" or "pageheight")
    var snowdistance = "pageheight";

    ///////////Stop Config//////////////////////////////////

    var ie4up = (document.all) ? 1 : 0;
    var ns6up = (document.getElementById && !document.all) ? 1 : 0;

    function iecompattest() {
        return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body
    }

    var dx, xp, yp;    // coordinate and position variables
    var am, stx, sty;  // amplitude and step variables
    var i, doc_width = 800, doc_height = 600;

    if (ns6up) {
        doc_width = self.innerWidth;
        doc_height = self.innerHeight;
    } else if (ie4up) {
        doc_width = iecompattest().clientWidth;
        doc_height = iecompattest().clientHeight;
    }

    dx = new Array();
    xp = new Array();
    yp = new Array();
    am = new Array();
    stx = new Array();
    sty = new Array();

    //snowsrc=(snowsrc.indexOf("dynamicdrive.com")!=-1)? "snow.gif" : snowsrc

    for (i = 0; i < no; ++i) {
        count = i % 3;

        dx[i] = 0;                        // set coordinate variables
        xp[i] = Math.random() * (doc_width - 50);  // set position variables
        yp[i] = Math.random() * doc_height;
        am[i] = Math.random() * 20;         // set amplitude variables
        stx[i] = 0.02 + Math.random() / 10; // set step variables
        sty[i] = 0.7 + Math.random();     // set step variables
        if (ie4up || ns6up) {
            if (i == 0) {
                document.write("<div id=\"dot" + i + "\" style=\"POSITION: absolute; Z-INDEX: 999999999; VISIBILITY: visible; TOP: 15px; LEFT: 15px;\"><a href=\"http://dynamicdrive.com\"><img src='" + snowarr[count] + "' border=\"0\"><\/a><\/div>");
            } else {
            document.write("<div id=\"dot" + i + "\" style=\"POSITION: absolute; Z-INDEX: 999999999; VISIBILITY: visible; TOP: 15px; LEFT: 15px;\"><img src='" + snowarr[count] + "' border=\"0\"><\/div>");
                //alert(snowsrc);
            }
        }
    }

    function snowIE_NS6() {  // IE and NS6 main animation function
        doc_width = ns6up ? window.innerWidth - 10 : iecompattest().clientWidth - 10;
        doc_height = (window.innerHeight && snowdistance == "windowheight") ? window.innerHeight : (ie4up && snowdistance == "windowheight") ? iecompattest().clientHeight : (ie4up && !window.opera && snowdistance == "pageheight") ? iecompattest().scrollHeight : iecompattest().offsetHeight;
        for (i = 0; i < no; ++i) {  // iterate for every dot
            yp[i] += sty[i];
            if (yp[i] > doc_height - 50) {
                xp[i] = Math.random() * (doc_width - am[i] - 30);
                yp[i] = 0;
                stx[i] = 0.02 + Math.random() / 10;
                sty[i] = 0.7 + Math.random();
            }
            dx[i] += stx[i];
            document.getElementById("dot" + i).style.top = yp[i] + "px";
            document.getElementById("dot" + i).style.left = xp[i] + am[i] * Math.sin(dx[i]) + "px";
        }
        snowtimer = setTimeout("snowIE_NS6()", 10);
    }

    function hidesnow() {
        if (window.snowtimer) clearTimeout(snowtimer)
        for (i = 0; i < no; i++) document.getElementById("dot" + i).style.visibility = "hidden"
    }


    if (ie4up || ns6up) {
        snowIE_NS6();
        if (hidesnowtime > 0)
            setTimeout("hidesnow()", hidesnowtime * 500)
    }

</script>--%>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $("#pageloaddiv").fadeOut(2000);
    });
</script>
<style type="text/css">
#pageloaddiv {
position: fixed;
left: 0px;
top: 0px;
width: 100%;
height: 100%;
z-index: 999999999;
background: url('http://www.bgcacdcp.org/images/loader1.gif') no-repeat center center #000;
opacity:0.8;
}
</style>  

    <script type = "text/javascript">
        function Confirm() {
            var confirm_value = document.createElement("INPUT");
            confirm_value.type = "hidden";
            confirm_value.name = "confirm_value";
            if (confirm("Your request is pending for an approval from Supervisor.\n Do you want to re-send a request to the supervisor?")) {
                confirm_value.value = "Yes";
            } else {
                confirm_value.value = "No";
            }
            document.forms[0].appendChild(confirm_value);
        }
    </script>


    <script type="text/javascript">

        //////////F12 disable code////////////////////////
        document.onkeypress = function(event) {
            event = (event || window.event);
            if (event.keyCode == 123) {
                //alert('No F-12');
                return false;
            }
        }
        document.onmousedown = function(event) {
            event = (event || window.event);
            if (event.keyCode == 123) {
                //alert('No F-keys');
                return false;
            }
        }
        document.onkeydown = function(event) {
            event = (event || window.event);
            if (event.keyCode == 123) {
                //alert('No F-keys');
                return false;
            }
        }
        /////////////////////end///////////////////////
</script>



<script type = "text/javascript" >

    function preventBack() { window.history.forward(); }

    setTimeout("preventBack()", 0);

    window.onunload = function() { null };

</script>


<script type="text/javascript">
    var msg_box = "You dont have permission to copy";
    function dis_rightclickIE() {
        if (navigator.appName == 'Microsoft Internet Explorer' && (event.button == 2 || event.button == 3))
            alert(msg_box)
    }

    function dis_rightclickNS(e) {
        if ((document.layers || document.getElementById && !document.all) && (e.which == 2 || e.which == 3)) {
            alert(msg_box)
            return false;
        }
    }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = dis_rightclickNS;
    }
    else if (document.all && !document.getElementById) {
        document.onmousedown = dis_rightclickIE;
    }
    document.oncontextmenu = new Function("alert(msg_box);return false")
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Spillett Leadership University</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
 <link id="Link1" runat="server" rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
                <link id="Link2" runat="server" rel="icon" href="favicon.ico" type="image/ico"/>
                
       <link href="css/skdslider.css" rel="stylesheet" type="text/css"/>
      <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/fancyfields-1.2.min.js" type="text/javascript"></script>
<script src="js/skdslider.js" type="text/javascript"></script>
<script src="js/skdslider.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".demo").fancyfields();
        $(".customSBDemo").fancyfields({ customScrollBar: true });

        $("#demoReset").click(function() {
            $(".demo").fancyfields("reset");
            $(".customSBDemo").fancyfields("reset");
        });
    });
	</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#demo1').skdslider({ 'delay': 5000, 'animationSpeed': 2000, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading' });
        jQuery('#demo2').skdslider({ 'delay': 5000, 'animationSpeed': 1000, 'showNextPrev': true, 'showPlayButton': false, 'autoSlide': true, 'animationType': 'sliding' });
        jQuery('#demo3').skdslider({ 'delay': 5000, 'animationSpeed': 2000, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading' });

        jQuery('#responsive').change(function() {
            $('#responsive_wrapper').width(jQuery(this).val());
        });

    });
</script> 


<script type="text/javascript">
    jQuery(document).ready(function() {
        $(".mark").on({
            mouseover: function() {
                $(".icontent").stop().show(500);
            },

            mouseout: function() {
                $(".icontent").stop().hide(500);
            }
        })
    });
			
</script> 


         
</head>

<body>
<div id="pageloaddiv"></div>
    <form id="form1" runat="server">
    <div>
    <asp:Label ID="action_check" runat="server" Text="" style="display:none"></asp:Label>
<!--start header-->
        <div class="header">
            <div class="wrapper">
                <div class="logo">
                    <a href="Home.aspx">
                    <img alt="Spillett Leadership University" src="images/logo.png" 
                        title="Spillett Leadership University" /></a></div>
                <div class="header_right">
                    <div class="header_top">
                        <span class="title">Club Directors Certificate Program</span>
                        <span class="register_btn"><a href="User_Registration.aspx"> <img alt="icon" src="images/enroll_icon.png" title="Enroll icon" />  Enroll</a></span>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a class="active" href="Home.aspx">Home</a></li>
                            <li><a href="Aboutus.aspx">About</a></li>
                            <li><a href="Learning.aspx">Learning Matrix</a></li>
                            <li><a href="faq.aspx">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clr">
            </div>
        </div>
        <div class="clr">
        </div>
<!--end header-->
<!--start banner-->


<div class="banner">

<div class="user_login">
                    <div class="login_con">
                        <label>
                        User Name<asp:RequiredFieldValidator ID="RequiredFieldValidator1" 
                            runat="server" ControlToValidate="userid" ErrorMessage="*"></asp:RequiredFieldValidator></label><asp:TextBox ID="userid" runat="server"  ></asp:TextBox><label>Password<asp:RequiredFieldValidator ID="RequiredFieldValidator2" 
                            runat="server" ControlToValidate="password" ErrorMessage="*"></asp:RequiredFieldValidator></label><asp:TextBox ID="password" runat="server" TextMode="Password" onkeydown="if (event.keyCode == 13) document.getElementById('user_login').click()"></asp:TextBox><div class="clr">
                        </div>
                        <div class="login_link">
                            
                            <a class="logint_t" <asp:LinkButton ID="user_login" runat="server" onclick="user_login_Click">Login                          
                            </asp:LinkButton>
                               </a>
                             
                            <div class="remember">
                                 <%--<input id="checkboxG1" class="css-checkbox" name="checkboxG1" type="checkbox" />
                                <label class="css-label" for="checkboxG1">
                                Remember Me!</label>--%>
                                
                                
                                <asp:CheckBox ID ="checkboxG1" runat="server" class="css-checkbox" name="checkboxG1" />
                               <span class="css-label" style="float:left; padding-left:5px;"><asp:Label ID="Label1" class="css-label" runat="server" Text="Remember Me!"></asp:Label></span>
                             <div class="clr"></div>
                                
                            </div>
                        </div> 
                        <div class="clr">
                        </div>
                        <div class="forgot_t">
                        <div style=" float:left; width:118px; text-align:left;">
                            <a href="forget_password.aspx">Forgot Password!</a>
                            <a href="forget_username.aspx">Forgot Username</a>
                            
                        </div>
                        <div style=" float:right; width:148px; text-align:right; margin-top: 10px;">
                            <a href="User_Registration.aspx" style="text-decoration:underline;">Create Account Here</a>
                        </div>
                        
                        </div>
                    </div> 
                </div>
<div id="responsive_wrapper">
<ul id="demo3">
<li>
<div class="wrapper" style="position:relative;">
<div class="banner_right">
<h1>
<span>Demonstrate commitment and build credibility</span><br />
<span>Increase skills and competencies</span><br />
<span>Enhance your professional development</span>
</h1>
</div>

</div>
<img src="images/banner01.jpg" alt="" />
</li>
<li>
<div class="wrapper" style="position:relative;">

<div class="banner_right">
<h1>
<span>Demonstrate commitment and build credibility</span><br />
<span>Increase skills and competencies</span><br />
<span>Enhance your professional development</span>
</h1>
</div>

</div>
<img src="images/banner02.jpg" alt="" />
</li>
<li>
<div class="wrapper" style="position:relative;">

<div class="banner_right">
<h1>
<span>Demonstrate commitment and build credibility</span><br />
<span>Increase skills and competencies</span><br />
<span>Enhance your professional development</span>
</h1>
</div>

</div>
<img src="images/banner03.jpg" alt="" />
</li>
<li>
<div class="wrapper" style="position:relative;">

<div class="banner_right">
<h1>
<span>Demonstrate commitment and build credibility</span><br />
<span>Increase skills and competencies</span><br />
<span>Enhance your professional development</span>
</h1>
</div>

</div>
<img src="images/banner04.jpg" alt="" />
</li>

</ul>
</div>

</div>



<%--///////////////////////////////////////////--%>
        <%--<div class="banner">
            <div class="wrapper">
                
                <h1>
                    <span>Lorem ipsum dolor sit amet 
                    <br />
                    consectetur elit Qui<br />
                    sque pulvinar</span></h1>
            </div>
        </div>--%>
<!--end banner-->
        <div class="clr"></div>
<!--start body content-->
        <div class="wrapper">
            <div class="body_con">
<!--<div class="video"><img src="images/video.jpg" class="vd" alt="" title="" /></div>-->
               <%-- <h2>
                    GREAT FUTURES START HERE</h2>
                    <img src="images/ft_img.jpg" />--%>
                  <div class="testimonial">             
                    <p>"This is a great opportunity for Club Directors to be recognized for their training and development."<br />
<strong>Jim Caufield,<br /> National Conference Manager & Senior Director, Training & Professional Development </strong></p>
            	</div>          
                    
                <div class="icons_controlar">
                <h2 class="text_center"><span>Contact Us</span></h2>
                <div class="clr"></div>
                    <div class="icons_cont">
                        <ul>
                            <li>
                                <div class="icons_con">
                                    <a class="button hover-shadow" 
                                        href="mailto:cdcp@bgca.org" 
                                        target="_blank">
                                    <img align="middle" class="icon1" src="images/icon1.png" /></a>
                                    <div class="clr">
                                    </div>
                                </div>
                                <div class="icon_text">
                                    <h3 class="icon_text_t">
                                        BGCA Staff</h3>
                                    <p>
                                        Click above to contact BGCA staff about Enrollment information or other 
                                        questions regarding the Club Directors Certificate Program.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="icons_cont">
                        <ul>
                            <li>
                                <div class="icons_con2">
                                    <a class="button hover-shadow" href="mailto:support@gitmar.com">
                                    <img align="middle" class="icon2" src="images/icon2.png" /></a>
                                    <div class="clr">
                                    </div>
                                </div>
                                <div class="icon_text">
                                    <h3 class="icon_text_t2">
                                        Technical Support</h3>
                                    <p>
                                        Contact our technical support team by submitting a ticket with any issues with 
                                        the Club Directors Certificate Program Website.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="icons_cont">
                        <ul>
                            <li>
                                <div class="icons_con3">
                                    <a class="button ho
    ver-shadow" href="http://bgca.net/Departments/TPD/LeadershipUniversity/Default.aspx" 
                                        target="_blank">
                                    <img align="middle" class="icon3" src="images/icon3.png" /></a>
                                    <div class="clr">
                                    </div>
                                </div>
                                <div class="icon_text">
                                    <h3 class="icon_text_t3">
                                        Spillett Leadership University</h3>
                                    <p>
                                        Learn more about the Spillett Leadership University on .net</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clr">
        </div>
        <br />
        <br />



<!--footer start-->
<!--<div class="footer" style="margin-top:30px; font-family:Arial, Helvetica, sans-serif;">
    <div class="wrapper">
    	<div class="footer_blog">
        	<h3>Credits</h3>
            	<ul>
                	<li><img src="images/credist_img1.jpg" alt="" /> <p>Fusce eget iacu iaculis lorem</p><div class="clr"></div></li>
                    <li><img src="images/credist_img2.jpg" alt="" /> <p>Fusce eget iacu iaculis lorem</p><div class="clr"></div></li>
                    <li><img src="images/credist_img3.jpg" alt="" /> <p>Fusce eget iacu iaculis lorem</p><div class="clr"></div></li>             
                </ul>
        </div>
        
        <div class="footer_blog">
        	<h3>Credits</h3>
            	<ul>
                	<li><img src="images/credist_img4.jpg" alt="" /> <p>Fusce eget iacu iaculis lorem</p><div class="clr"></div></li>
                    <li><img src="images/credist_img5.jpg" alt="" /> <p>Fusce eget iacu iaculis lorem</p><div class="clr"></div></li>
                    <li><img src="images/credist_img6.jpg" alt="" /> <p>Fusce eget iacu iaculis lorem</p><div class="clr"></div></li>             
                </ul>
        </div>
        
        <div class="footer_blog_idget">
        	<h3>Contact Widget</h3>
            	<input type="text" placeholder="Name" />
                <div class="clr10"></div>
                <input type="text" placeholder="Email"/>
                <div class="clr10"></div>
                <textarea placeholder="Message"></textarea>
                <div class="clr10"></div>
                <input type="submit" value="Submit" />
        </div>
         <div class="clr"></div>
        <p class="Copyright">Copyright 2014, Lorem Ipsums</p>
        
    </div>
    <div class="clr"></div>
</div>-->

        <div class="footer" style="font-family:Arial, Helvetica, sans-serif;">
            <div class="wrapper">
    	
          <!-- <p class="lor_con1">Lorem Ipsum Dolor Sit Amet</p>-->
  
                <p class="nul_con">
                    <a href="#" class="mark">Best viewed with Google Chrome, Internet Explorer 10.0 or later, Mozilla Firefox 
                    Or later or Apple Safari or later (whichever applies). </a>
                </p> 
                <div class="clr">
                <div class="icontent">Best viewed with Google Chrome, Internet Explorer 10.0 or later, Mozilla Firefox Or later or Apple Safari or later (whichever applies).</div>
           <div class="clr">
                </div>
                <p class="Copyright" style="text-align:center;">
                    © 2014 Boys &amp; Girls Clubs of America. All Rights Reserved.<span 
                        style="padding-left:2%;"><a href="http://www.bgca.org/legal.htm" 
                        target="_blank">Legal Notice</a></span> &amp; <span>
                    <a href="http://www.bgca.org/legal.htm" target="_blank">Privacy Policy</a></span>
                    <span class="admin_icon"><img align="bottom" src="images/admin_icons.png" width="10" height="10" /> <a href="Admin_login.aspx" target="_blank">Admin</a></span>
                     <span class="admin_icon"><img align="bottom" src="images/admin_icons.png" width="10" height="10" /> <a href="Super_admin_login.aspx" target="_blank">Super Admin</a></span>
                    </p>
            </div>
            <div class="clr">
            </div>
        </div>
<!--footer end-->
        <div class="clr">
        </div>
<!--end body content-->
    
    </div>
<!--footer end-->
        <div class="clr">
        </div>
<!--end body content-->
    
    </div>
    

    </form>
    
    
    
    
    
    
    
    
    
        <script class="secret-source">
            jQuery(document).ready(function($) {

                $('#banner-slide').bjqs({
                    animtype: 'slide',
                    height: 495,
                    width: 1000,
                    responsive: true,
                    randomstart: true
                });

            });
      </script>
</body>
</html>