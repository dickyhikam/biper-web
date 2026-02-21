<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; margin: 0; padding: 20px; background-color: #fef0f8;">

    <div style="max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">

        {{-- Header --}}
        <div style="background: linear-gradient(135deg, #df1995 0%, #40d7e3 100%); padding: 36px 24px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700;">Selamat Datang! 🎉</h1>
        </div>

        {{-- Body --}}
        <div style="padding: 36px 28px;">
            <p style="font-size: 15px; color: #333333; margin: 0 0 16px;">
                Halo <strong>{{ $userName }}</strong>,
            </p>

            <p style="font-size: 14px; color: #666666; line-height: 1.6; margin: 0 0 12px;">
                Akun Anda telah dibuat di <strong>Biper Baby Spa</strong> sebagai <strong>{{ $userRole }}</strong>.
            </p>

            <p style="font-size: 14px; color: #666666; line-height: 1.6; margin: 0 0 28px;">
                Silakan klik tombol di bawah untuk membuat password dan mulai menggunakan akun Anda.
            </p>

            {{-- CTA Button --}}
            <div style="text-align: center; margin: 0 0 24px;">
                <a href="{{ $setPasswordUrl }}"
                    style="display: inline-block; background-color: #df1995; color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; padding: 14px 36px; border-radius: 50px; box-shadow: 0 4px 12px rgba(223, 25, 149, 0.3);">
                    Buat Password
                </a>
            </div>

            <p style="font-size: 13px; color: #999999; text-align: center; margin: 0 0 28px;">
                Link ini berlaku selama <strong>24 jam</strong>
            </p>

            <div style="background: #f8f9fa; border-radius: 10px; padding: 16px; margin: 0 0 0;">
                <p style="font-size: 13px; color: #666666; line-height: 1.6; margin: 0;">
                    Jika tombol di atas tidak berfungsi, salin dan buka link berikut di browser:
                </p>
                <p style="font-size: 12px; color: #df1995; word-break: break-all; margin: 8px 0 0;">
                    {{ $setPasswordUrl }}
                </p>
            </div>
        </div>

        {{-- Footer --}}
        <div style="background: #f8f9fa; padding: 20px 28px; text-align: center; border-top: 1px solid #eeeeee;">
            <p style="margin: 0; font-size: 13px; color: #666666;">
                <strong style="color: #df1995;">Biper Baby Spa</strong> &middot; Sidoarjo
            </p>
            <p style="margin: 4px 0 0; font-size: 12px; color: #999999;">
                Email ini dikirim otomatis. Mohon tidak membalas email ini.
            </p>
        </div>

    </div>

</body>
</html>
