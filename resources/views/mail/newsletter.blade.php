<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>EHATA Latest Insight: {{$post->title}}.</title>
    <style type="text/css">
        /* Client-specific styles and resets */
        body {
            margin: 0;
            padding: 0;
            min-width: 100%;
            background-color: #f4f4f4;
        }

        table {
            border-spacing: 0;
            font-family: sans-serif;
            color: #333333;
        }

        td {
            padding: 0;
        }

        img {
            border: 0;
        }

        /* Outer wrappers for responsiveness */
        .wrapper {
            width: 100%;
            table-layout: fixed;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        .webkit {
            max-width: 600px;
            margin: 0 auto;
        }

        .outer {
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
        }

        .inner {
            padding: 30px;
        }

        /* General element styling */
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0 0 10px 0;
        }

        a {
            color: #8B0000;
            text-decoration: none;
        }

        /* EHATA Primary color */
        .button {
            background-color: #8B0000;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            text-decoration: none;
            font-size: 16px;
        }

        .header {
            background-color: #000000;
            padding: 20px 30px;
            text-align: center;
        }

        /* Black background for header */
        .footer {
            background-color: #8B0000;
            color: #ffffff;
            padding: 30px;
            text-align: center;
            font-size: 12px;
        }

        /* Blog Post Specific */
        .post-title {
            font-size: 28px;
            line-height: 36px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 20px;
        }

        .post-meta {
            font-size: 14px;
            color: #777777;
            margin-bottom: 15px;
        }

        .post-content p {
            font-size: 16px;
            line-height: 24px;
            color: #555555;
            margin-bottom: 15px;
        }

        .post-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        /* Mobile Styles */
        @media only screen and (max-width: 600px) {
            .outer {
                width: 100% !important;
                max-width: 100% !important;
            }

            .inner {
                padding: 20px !important;
            }

            .header img {
                max-width: 120px !important;
                height: auto !important;
            }

            .post-title {
                font-size: 24px !important;
                line-height: 32px !important;
            }

            .post-meta {
                font-size: 12px !important;
            }

            .post-content p {
                font-size: 14px !important;
                line-height: 22px !important;
            }

            .button {
                padding: 10px 18px !important;
                font-size: 14px !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:0; min-width:100%; background-color:#f4f4f4;">
<center class="wrapper">
    <div class="webkit">
        <!-- Email Outer Wrapper -->
        <table class="outer" align="center"
               style="width:100%; max-width:600px; background-color:#ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
            <tr>
                <td class="header" style="background-color:#000000; padding:20px 30px; text-align:center;">
                    <a href="https://ehaata.com" target="_blank">
                        <img src="{{asset('images/Logo-dark.svg')}}" alt="EHATA Logo" width="150"
                             style="width:150px; max-width:100%; height:auto; display:block; margin:0 auto;"/>
                    </a>
                </td>
            </tr>

            <!-- Optional Introductory Text -->
            <tr>
                <td style="padding: 30px 30px 0 30px; text-align:center;">
                    <p style="font-size:16px; line-height:24px; color:#555555; margin-bottom:25px;">
                        Dear Subscriber,
                    </p>
                    <p style="font-size:16px; line-height:24px; color:#555555; margin-bottom:25px;">
                        We're excited to share our latest insight with you. This post offers a deep dive into crucial developments relevant to operations in Libya.
                    </p>
                    <hr style="border:0; border-top:1px solid #eeeeee; margin:30px 0;">
                </td>
            </tr>

            <!-- Main Content Area: Single Blog Post -->
            <tr>
                <td class="inner" style="padding:30px; text-align:left;">
                    <p style="font-size:12px; color:#8B0000; text-transform:uppercase; margin-bottom:10px; text-align:center;">
                        General
                    </p>

                    <h1 class="post-title" style="text-align:center;">
                        <a href="https://ehaata.com/blog/{{$post->slug}}" target="_blank"
                           style="color:#333333; text-decoration:none;">
                            {{$post->title}}
                        </a>
                    </h1>

                    <p class="post-meta" style="text-align:center;">
                        By EHATA Team &bull; {{ $post->created_at->format('F j, Y') }}
                    </p>

                    <a href="https://ehaata.com/blog/{{$post->slug}}" target="_blank">
                        <img class="post-image" src="{{$postImage}}" alt="Blog Post Image" width="540"
                             style="width:100%; max-width:540px; height:auto; display:block; margin:0 auto 20px auto;"/>
                    </a>

                    <div class="post-content" style="color:#555555;">
                        {!! $post->excerpt !!}
                    </div>

                    <div style="text-align:center; margin-top:30px;">
                        <a href="https://ehaata.com/blog/{{$post->slug}}" class="button" target="_blank"
                           style="background-color:#8B0000; color:#ffffff; padding:12px 25px; border-radius:5px; display:inline-block; font-weight:bold; text-decoration:none;">
                            Read Full Article on Our Website
                        </a>
                    </div>
                </td>
            </tr>
            <!-- Spacer -->
            <tr>
                <td style="padding:15px; background-color:#f4f4f4;">&nbsp;</td>
            </tr>
            <!-- Footer -->
            <tr>
                <td class="footer"
                    style="background-color:#8B0000; color:#ffffff; padding:30px; text-align:center; font-size:12px;">
                    <p style="margin-bottom:15px; font-weight:bold; font-size:14px;">In a landscape where uncertainty defines decision-making, Ehata brings clarity through intelligence-led risk consulting.</p>
                    <p style="margin-bottom:15px;">
                        Email: <a href="mailto:info@ehaata.com" style="color:#ffffff; text-decoration:underline;">info@ehaata.com</a>
                        |
                        Website: <a href="https://ehaata.com" target="_blank"
                                    style="color:#ffffff; text-decoration:underline;">Ehaata.com</a>
                    </p>
                    <p style="margin-bottom:15px;">
                        <a href="https://x.com/ehaata" target="_blank"
                           style="color:#ffffff; text-decoration:none; margin:0 5px;">
                            <x-tabler-brand-twitter style="vertical-align:middle;" width="20" height="20"/>
                        </a>
                        <a href="https://www.linkedin.com/company/ehata-consultancy/" target="_blank"
                           style="color:#ffffff; text-decoration:none; margin:0 5px;">
                            <x-tabler-brand-linkedin style="vertical-align:middle;" width="20" height="20"/>
                        </a>
                    </p>
                    <p>Copyright Ehata &copy; 2023 All rights reserved</p>
                    <p style="margin-top:20px;">
                        <a href="https://ehaata.com/docs/Privacy_Policy.pdf" target="_blank"
                           style="color:#ffffff; text-decoration:underline;">Privacy Policy</a> |
                        <a href="https://ehaata.com/docs/T&C.pdf" target="_blank"
                           style="color:#ffffff; text-decoration:underline;">Terms & Conditions</a>
                    </p>
                </td>
            </tr>
        </table>
        <!-- End Email Outer Wrapper -->
    </div>
</center>
</body>
</html>
