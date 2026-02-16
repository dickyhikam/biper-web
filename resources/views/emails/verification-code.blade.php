<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; margin: 0; padding: 20px; background-color: #fef0f8;">

    <div style="max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">

        {{-- Header --}}
        <div style="background: linear-gradient(135deg, #df1995 0%, #40d7e3 100%); padding: 36px 24px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700;">Verifikasi Email Anda</h1>
        </div>

        {{-- Body --}}
        <div style="padding: 36px 28px;">
            <p style="font-size: 15px; color: #333333; margin: 0 0 16px;">
                Halo <strong>{{ $userName }}</strong>,
            </p>

            <p style="font-size: 14px; color: #666666; line-height: 1.6; margin: 0 0 28px;">
                Terima kasih telah mendaftar di Biper Baby Spa! Untuk menyelesaikan pendaftaran,
                masukkan kode verifikasi berikut:
            </p>

            {{-- Code Box --}}
            <div style="background: #fef0f8; border: 2px dashed #df1995; border-radius: 12px; padding: 24px; text-align: center; margin: 0 0 24px;">
                <div style="font-size: 36px; font-weight: 800; letter-spacing: 10px; color: #df1995; font-family: 'Courier New', monospace;">
                    {{ $code }}
                </div>
            </div>

            <p style="font-size: 13px; color: #999999; text-align: center; margin: 0 0 28px;">
                Kode ini akan kadaluarsa dalam <strong>{{ $expiryMinutes }} menit</strong>
            </p>

            <p style="font-size: 14px; color: #666666; line-height: 1.6; margin: 0 0 0;">
                Jika Anda tidak mendaftar di Biper Baby Spa, abaikan email ini.
            </p>
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
