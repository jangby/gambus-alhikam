<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; }
        }
        body { font-family: 'Times New Roman', Times, serif; }
    </style>
</head>
<body class="bg-gray-100 p-10 print:p-0 print:bg-white" onload="window.print()">

    <div class="max-w-4xl mx-auto bg-white p-10 shadow-lg print:shadow-none">
        
        <div class="text-center border-b-2 border-black pb-4 mb-6">
            <h1 class="text-3xl font-bold uppercase tracking-widest">Grup Gambus Al-Harmoni</h1>
            <p class="text-sm">Jalan Kenangan No. 12, Kota Seni, Indonesia</p>
            <p class="text-sm">Telp: 0812-3456-7890 | Email: info@gambus.com</p>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-xl font-bold underline uppercase">{{ $title }}</h2>
            <p class="text-sm text-gray-600">Dicetak pada: {{ date('d F Y, H:i') }}</p>
        </div>

        <table class="w-full border-collapse border border-black text-sm mb-6">
            <thead>
                <tr class="bg-gray-200 text-black">
                    <th class="border border-black px-3 py-2 text-center w-10">No</th>
                    <th class="border border-black px-3 py-2 text-left">Tanggal</th>
                    <th class="border border-black px-3 py-2 text-left">Keterangan</th>
                    <th class="border border-black px-3 py-2 text-right">Masuk (+)</th>
                    <th class="border border-black px-3 py-2 text-right">Keluar (-)</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse($transactions as $trx)
                <tr>
                    <td class="border border-black px-3 py-2 text-center">{{ $no++ }}</td>
                    <td class="border border-black px-3 py-2">{{ \Carbon\Carbon::parse($trx->date)->format('d/m/Y') }}</td>
                    <td class="border border-black px-3 py-2">{{ $trx->description }}</td>
                    <td class="border border-black px-3 py-2 text-right">
                        @if($trx->type == 'income') Rp {{ number_format($trx->amount, 0, ',', '.') }} @else - @endif
                    </td>
                    <td class="border border-black px-3 py-2 text-right">
                        @if($trx->type == 'expense') Rp {{ number_format($trx->amount, 0, ',', '.') }} @else - @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border border-black px-3 py-4 text-center italic">Tidak ada transaksi pada periode ini.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot class="font-bold bg-gray-100">
                <tr>
                    <td colspan="3" class="border border-black px-3 py-2 text-right">TOTAL</td>
                    <td class="border border-black px-3 py-2 text-right">Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
                    <td class="border border-black px-3 py-2 text-right">Rp {{ number_format($totalExpense, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="border border-black px-3 py-2 text-right uppercase">Sisa Saldo (Profit)</td>
                    <td colspan="2" class="border border-black px-3 py-2 text-center text-lg">
                        Rp {{ number_format($balance, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="flex justify-end mt-16 px-10">
            <div class="text-center">
                <p class="mb-20">Bendahara,</p>
                <p class="font-bold underline">( ....................................... )</p>
            </div>
        </div>

        <div class="mt-10 text-center no-print">
            <button onclick="window.history.back()" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-700">
                &larr; Kembali
            </button>
        </div>

    </div>
</body>
</html>