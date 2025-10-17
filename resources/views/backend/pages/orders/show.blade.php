@extends('backend.layouts.master')

@section('title', 'Order Invoice')

@push('backend_style')
    <style>
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #fff;
        }

        .invoice-header {
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .invoice-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .customer-info, .order-info {
            width: 48%;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .invoice-summary {
            width: 300px;
            margin-left: auto;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .summary-row.total {
            border-top: 2px solid #333;
            font-weight: bold;
            margin-top: 5px;
            padding-top: 10px;
        }

        .print-btn {
            text-align: center;
            margin-top: 30px;
        }

        .print-btn button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .print-btn button:hover {
            background-color: #0056b3;
        }

        @media print {
            .no-print {
                display: none;
            }

            body * {
                visibility: visible;
            }

            .invoice-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 20px;
                font-size: 12px;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .invoice-table th, .invoice-table td {
                padding: 6px;
            }

            .invoice-summary {
                width: 250px;
            }

            /* Improve text clarity for print */
            * {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }

        /* PDF specific styles */
        @media screen and (max-width: 768px) {
            .invoice-details {
                flex-direction: column;
            }

            .customer-info, .order-info {
                width: 100%;
                margin-bottom: 15px;
            }
        }

        /* High resolution print styles */
        @media print and (min-resolution: 300dpi) {
            .invoice-container {
                font-size: 14px;
            }

            .invoice-table th, .invoice-table td {
                padding: 8px;
            }
        }
    </style>
@endpush

@section('backend_content')
    <div class="invoice-container" id="invoice">
        <div class="invoice-header">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        @if($logo_favicon && $logo_favicon->logo)
                            <img src="{{ asset($logo_favicon->logo) }}" alt="{{ $logo_favicon->web_name ?? config('app.name') }}" style="max-height: 80px; max-width: 200px; margin-bottom: 15px;">
                        @endif
                        <h2 class="text-dark">ORDER INVOICE</h2>
                        <p>{{ $logo_favicon->web_name ?? config('app.name', 'E-Commerce') }}</p>
                        <p>{{ $website_link->address ?? '123 Main Street, City, Country' }}</p>
                        <p>Email: {{ $website_link->email ?? 'info@example.com' }} | Phone: {{ $website_link->number ?? '+1234567890' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-title">
            <h3 class="text-dark">INVOICE #{{ $order->order_number }}</h3>
        </div>

        <div class="invoice-details">
            <div class="customer-info">
                <h5 class="text-dark"><strong>BILL TO:</strong></h5>
                <p>{{ $order->name }}</p>
                <p>{{ $order->email ?? 'N/A' }}</p>
                <p>{{ $order->phone }}</p>
                <p>{{ $order->address }}</p>
            </div>

            <div class="order-info">
                <h5 class="text-dark"><strong>ORDER DETAILS:</strong></h5>
                <p><strong>Invoice No:</strong> {{ $order->order_number }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y h:i A') }}</p>
                <p><strong>Status:</strong>
                    <span class="badge
                        @if($order->status == 'pending') bg-warning
                        @elseif($order->status == 'confirmed') bg-info
                        @elseif($order->status == 'processing') bg-primary
                        @elseif($order->status == 'shipped') bg-secondary
                        @elseif($order->status == 'delivered') bg-success
                        @elseif($order->status == 'cancelled') bg-danger
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th class="text-right">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div>
                                <strong>{{ $item->product_name }}</strong>
                                @if($item->product)
                                    {{-- <br><small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small> --}}
                                @endif
                            </div>
                        </td>
                        <td>Tk {{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="text-right">Tk {{ number_format($item->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="invoice-summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>Tk {{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>Shipping Cost:</span>
                <span>Tk {{ number_format($order->shipping_cost, 2) }}</span>
            </div>
            <div class="summary-row total">
                <span>TOTAL:</span>
                <span>Tk {{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div class="print-btn no-print">
            <button onclick="printInvoice()">
                <i class="fa fa-print"></i> Print Invoice
            </button>
            <button onclick="downloadPDF()" class="ms-2">
                <i class="fa fa-download"></i> Download PDF
            </button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary ms-2">
                <i class="fa fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
@endsection

@push('backend_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function printInvoice() {
            window.print();
        }

        function downloadPDF() {
            const element = document.getElementById('invoice');
            const printBtn = document.querySelector('.print-btn');

            // Hide the print buttons temporarily
            if (printBtn) {
                printBtn.style.display = 'none';
            }

            // Improve text clarity by temporarily increasing font size
            const originalFontSize = element.style.fontSize;
            element.style.fontSize = '14px';

            const opt = {
                margin: 8,
                filename: 'invoice-{{ $order->order_number }}.pdf',
                image: { type: 'jpeg', quality: 1.0 },
                html2canvas: {
                    scale: 3, // Increased scale for better resolution
                    useCORS: true,
                    scrollY: 0,
                    scrollX: 0,
                    logging: false,
                    letterRendering: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff'
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait',
                    compress: false, // Disable compression for better quality
                    precision: 16
                },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };

            // Generate PDF and then restore the buttons and font size
            html2pdf().set(opt).from(element).save().then(() => {
                if (printBtn) {
                    printBtn.style.display = '';
                }
                element.style.fontSize = originalFontSize;
            });
        }
    </script>
@endpush
