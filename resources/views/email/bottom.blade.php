                </table>

                @php
                    $whiteBackground = 'https://storage.googleapis.com/liontax-assets/email/general/white-background.png';
                    $logoInstagram = 'https://storage.googleapis.com/liontax-assets/email/logo/logo-instagram.png';
                    $logoFacebook = 'https://storage.googleapis.com/liontax-assets/email/logo/logo-facebook.png';
                    $logoLinkedin = 'https://storage.googleapis.com/liontax-assets/email/logo/logo-linkedin.png';
                @endphp
            </div>

            <div style="background: url('{{ $whiteBackground }}'); border-left: 1px solid #E8EAEC; border-right: 1px solid #E8EAEC; border-bottom: 1px solid #E8EAEC; border-radius: 0 0 16px 16px">
                <div style="padding: 0 32px;">
                    <hr style="margin: 0 auto; border: 1px solid #E8EAEC; width: 100%;">
                </div>
                <table style="width: 100%; padding: 32px">
                    <tr>
                        <td align="left">
                            <span style="font-size: 12px; font-weight: 400; line-height: 24px; letter-spacing: 0.3; color: #0F0F0F;">Copyright © {{\App\Base\Helpers\DateHelper::now('year')}} Lion | <a href="{{ env('WEB_BASE_URL') }}politica-de-privacidade" style="text-decoration: none; color: #0F0F0F; text-decoration: underline;" target="_blank" rel="noopener noreferrer">Termos de Uso e Políticas de Privacidade</a></span>
                        </td>
                        <td style="text-align: right">
                            <a href="https://www.instagram.com/taxlion/" target="_blank" rel="noopener noreferrer" style="text-decoration: none; margin-left: 16px;">
                                <img src="{{ $logoInstagram }}" alt="Logo Instagram Lion Tax">
                            </a>
                            <a href="https://www.linkedin.com/company/liontax" target="_blank" rel="noopener noreferrer" style="text-decoration: none; margin-left: 16px;">
                                <img src="{{ $logoLinkedin }}" alt="Logo Linkedin Lion Tax">
                            </a>
                            <a href="https://www.facebook.com/liontax.br/" target="_blank" rel="noopener noreferrer" style="text-decoration: none; margin-left: 16px;">
                                <img src="{{ $logoFacebook }}" alt="Logo Facebook Lion Tax">
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
