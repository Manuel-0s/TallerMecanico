<?php
function plantillaRecuperacion(string $enlace, string $sistema = 'Taller Mecánico'): string {
    $enlace  = htmlspecialchars($enlace, ENT_QUOTES, 'UTF-8');
    $sistema = htmlspecialchars($sistema, ENT_QUOTES, 'UTF-8');
    $anio    = date('Y');

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f5; font-family:Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f5; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:480px; background-color:#ffffff; border:1px solid #e4e4e7; border-radius:12px;">

                    <tr>
                        <td style="padding:32px 32px 8px 32px; text-align:center;">
                            <span style="font-size:18px; font-weight:bold; color:#111111;">{$sistema}</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:16px 32px 0 32px; text-align:center;">
                            <h1 style="margin:0; font-size:22px; color:#111111;">Recupera tu contraseña</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:16px 32px 0 32px; text-align:center; font-size:15px; line-height:22px; color:#52525b;">
                            Recibimos una solicitud para restablecer la contraseña de tu cuenta.
                            Haz clic en el botón para crear una nueva.
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:28px 32px 0 32px;">
                            <a href="{$enlace}" style="display:inline-block; background-color:#111111; color:#ffffff; text-decoration:none; font-size:15px; font-weight:bold; padding:14px 32px; border-radius:8px;">
                                Restablecer contraseña
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:28px 32px 0 32px;">
                            <hr style="border:none; border-top:1px solid #e4e4e7; margin:0;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:16px 32px 0 32px; font-size:12px; line-height:18px; color:#71717a;">
                            Si el botón no funciona, copia y pega este enlace en tu navegador:<br>
                            <a href="{$enlace}" style="color:#111111; word-break:break-all;">{$enlace}</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:16px 32px 32px 32px; font-size:12px; line-height:18px; color:#71717a;">
                            Si no solicitaste este cambio, ignora este correo. Tu contraseña seguirá siendo la misma.
                        </td>
                    </tr>
                </table>

                <p style="margin:16px 0 0 0; font-size:12px; color:#a1a1aa;">
                    &copy; {$anio} {$sistema}. Todos los derechos reservados.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
}

function plantillaBienvenida(string $nombre, string $correo, string $contrasena, string $enlaceLogin, string $sistema = 'Taller Mecánico'): string {
    $nombre      = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $correo      = htmlspecialchars($correo, ENT_QUOTES, 'UTF-8');
    $contrasena  = htmlspecialchars($contrasena, ENT_QUOTES, 'UTF-8');
    $enlaceLogin = htmlspecialchars($enlaceLogin, ENT_QUOTES, 'UTF-8');
    $sistema     = htmlspecialchars($sistema, ENT_QUOTES, 'UTF-8');
    $anio        = date('Y');

    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Bienvenido</title></head>
<body style="margin:0; padding:0; background-color:#f4f4f5; font-family:Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:32px 16px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:480px; background:#ffffff; border:1px solid #e4e4e7; border-radius:12px; padding:32px;">
                    <tr>
                        <td style="text-align:center;">
                            <h1 style="margin:0 0 16px; font-size:22px; color:#111111;">¡Bienvenido a {$sistema}, {$nombre}!</h1>
                            <p style="font-size:15px; color:#52525b; line-height:22px;">
                                Tu cuenta ha sido creada exitosamente. Aquí tienes tus credenciales de acceso:
                            </p>
                            <p style="background:#f4f4f5; padding:12px; border-radius:8px; font-size:14px; color:#111111;">
                                <strong>Correo:</strong> {$correo}<br>
                                <strong>Contraseña:</strong> {$contrasena}
                            </p>
                            <a href="{$enlaceLogin}" style="display:inline-block; margin-top:16px; background:#111111; color:#ffffff; text-decoration:none; font-weight:bold; padding:12px 28px; border-radius:8px;">
                                Iniciar sesión
                            </a>
                        </td>
                    </tr>
                </table>
                <p style="margin-top:16px; font-size:12px; color:#a1a1aa;">&copy; {$anio} {$sistema}.</p>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
}