<!DOCTYPE html>
<html>

<head>
    <title>Barcode Label Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .barcode-box {
            width: 25%;
            /* 4 per row */
            padding: 10px;
            box-sizing: border-box;
        }

        .barcode-content {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            height: 100%;
        }

        .barcode-content p {
            margin: 4px 0;
            font-size: 12px;
            word-break: break-word;
            /* Ensures L/N doesn't overflow */
        }

        .barcode-content strong {
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
            }

            .barcode-box {
                page-break-inside: avoid;
            }

            .barcode-content {
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($dakAddresses as $dakAddresse)
            <div class="barcode-box">
                <div class="barcode-content">
                    {{-- <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($dakAddresse->date)->format('F j, Y') }}</p> --}}
                    <p><strong>Form:</strong> {{ $dakAddresse->unit->name }}</p>
                    <p><strong>To:</strong> {{ $dakAddresse->to_name }}</p>
                    <p><strong>L/N:</strong> {{ $dakAddresse->letter_no }}</p>
                    <div>{!! QrCode::size(80)->generate($dakAddresse->barcode) !!}</div>
                    <p>{{ $dakAddresse->barcode }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
