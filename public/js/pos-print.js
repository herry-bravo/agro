function printReceipt() {
    var printArea = document.getElementById('printArea');
    if (!printArea) return;

    var content = printArea.innerHTML;

    // Open popup: A4 width equivalent, tall enough for content
    var win = window.open('', '_blank', 'width=794,height=900,scrollbars=yes,toolbar=no,menubar=no,location=no,status=no');

    if (!win) {
        alert('Pop-up diblokir browser. Izinkan pop-up untuk halaman ini agar bisa mencetak struk.');
        return;
    }

    win.document.write([
        '<!DOCTYPE html>',
        '<html><head>',
        '<meta charset="UTF-8">',
        '<title>NOTA — AGRO POS</title>',
        '<style>',

        // Reset + page setup
        '* { box-sizing: border-box; margin: 0; padding: 0; }',
        '@page {',
        '  size: A4 portrait;',
        '  margin: 10mm 15mm;',
        '}',
        'html, body {',
        '  width: 210mm;',
        '  background: #fff;',
        '  font-family: "Segoe UI", Arial, sans-serif;',
        '  font-size: 13pt;',
        '  color: #000;',
        '  -webkit-print-color-adjust: exact;',
        '  print-color-adjust: exact;',
        '}',

        // Center the nota on A4 like a slip/voucher
        '.nota-wrap {',
        '  max-width: 160mm;',
        '  margin: 0 auto;',
        '  padding: 8mm 0;',
        '}',

        // Header
        '.receipt-header {',
        '  text-align: center;',
        '  margin-bottom: 6mm;',
        '  padding-bottom: 4mm;',
        '  border-bottom: 3px solid #000;',
        '}',
        '.receipt-header h5 {',
        '  font-size: 22pt;',
        '  font-weight: 900;',
        '  letter-spacing: 3px;',
        '  color: #000;',
        '  margin-bottom: 3mm;',
        '}',
        '.receipt-header small {',
        '  font-size: 11pt;',
        '  display: block;',
        '  color: #000;',
        '  margin-bottom: 1mm;',
        '  font-weight: 600;',
        '}',

        // Dividers
        'hr, .receipt-divider {',
        '  border: none;',
        '  border-top: 2px dashed #333;',
        '  margin: 4mm 0;',
        '  display: block;',
        '}',

        // Tables
        'table { width: 100%; border-collapse: collapse; }',

        // Items table
        'tbody tr td:first-child { font-size: 12pt; font-weight: 700; color: #000; padding: 2mm 0; }',
        'tbody tr td:last-child  { font-size: 12pt; font-weight: 700; color: #000; text-align: right; white-space: nowrap; padding: 2mm 0; }',
        'tbody tr td small { font-size: 10pt; font-weight: 500; color: #222; display: block; margin-top: 1mm; }',

        // Summary table (subtotal/total block)
        'table + hr + table td { font-size: 12pt; color: #000; padding: 1.5mm 0; }',
        'table + hr + table td:last-child { text-align: right; white-space: nowrap; font-weight: 700; }',
        'table + hr + table tr:last-child td { border-top: 2px solid #000; padding-top: 2mm; margin-top: 2mm; }',

        // TOTAL row — big
        '#rcptTotal, #rcptPaid, #rcptChange { font-size: 14pt; font-weight: 900; }',

        // Footer text
        'small.text-muted, #rcptSO, #rcptPPN {',
        '  font-size: 10pt;',
        '  color: #333;',
        '  display: block;',
        '  margin-top: 1.5mm;',
        '}',

        // Hide print button area
        '.no-print { display: none !important; }',

        // Separator line between items
        'tbody tr { border-bottom: 1px solid #ddd; }',
        'tbody tr:last-child { border-bottom: none; }',

        // Print-only visible
        '@media screen {',
        '  .nota-wrap { border: 1px solid #ccc; border-radius: 8px; padding: 12mm; margin: 10mm auto; box-shadow: 0 2px 12px rgba(0,0,0,.1); }',
        '}',

        '</style>',
        '</head>',
        '<body>',
        '<div class="nota-wrap">' + content + '</div>',
        '</body>',
        '</html>'
    ].join('\n'));

    win.document.close();

    // Auto-trigger print after render — no user action needed
    setTimeout(function () {
        win.focus();
        win.print();
        win.onafterprint = function () {
            win.close();
        };
    }, 400);
}
