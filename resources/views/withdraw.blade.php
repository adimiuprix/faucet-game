<x-dash-layout>
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />
        
        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <style>
                .pgw-wrap {
                    max-width: 680px;
                    margin: 0 auto;
                }
                .pgw-card {
                    background: var(--bg-secondary);
                    border: 1px solid rgba(160, 110, 255, 0.16);
                    border-radius: 16px;
                    padding: 26px;
                    margin-bottom: 20px;
                }
                .pgw-bal {
                    font-size: 30px;
                    font-weight: 800;
                    color: #fff;
                    margin: 6px 0 18px;
                }
                .pgw-card label {
                    color: #9b90c0;
                    font-size: 13px;
                    display: block;
                    margin-bottom: 6px;
                }
                .pgw-card input {
                    width: 100%;
                    padding: 13px;
                    border-radius: 10px;
                    background: rgba(255, 255, 255, 0.04);
                    border: 1.5px solid rgba(160, 110, 255, 0.28);
                    color: #fff;
                    font-size: 15px;
                    margin-bottom: 16px;
                }
                .pgw-btn {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: fit-content;
                    min-width: 210px;
                    margin: 4px auto 0;
                    padding: 12px 26px;
                    border: none;
                    border-radius: 12px;
                    background: var(--gradient);
                    color: #fff;
                    font-weight: 800;
                    font-size: 14px;
                    cursor: pointer;
                    text-align: center;
                    box-shadow: 0 10px 28px -14px rgba(124, 58, 237, 0.7);
                    transition: 0.15s;
                }
                .pgw-btn:hover {
                    filter: brightness(1.08);
                    transform: translateY(-1px);
                }
                @media (max-width: 480px) {
                    .pgw-btn {
                        font-size: 13px;
                        padding: 11px 20px;
                        width: 100%;
                    }
                }
                .pgw-tbl {
                    width: 100%;
                    font-size: 13px;
                    border-collapse: collapse;
                }
                .pgw-tbl th {
                    text-align: left;
                    color: #9b90c0;
                    padding: 9px;
                    border-bottom: 1px solid rgba(160, 110, 255, 0.15);
                    font-size: 11px;
                    text-transform: uppercase;
                }
                .pgw-tbl td {
                    padding: 9px;
                    border-bottom: 1px solid rgba(160, 110, 255, 0.07);
                    color: #d8cef5;
                }
                .badge {
                    padding: 3px 10px;
                    border-radius: 20px;
                    font-size: 11px;
                    font-weight: 700;
                }
                .b-Pending {
                    background: rgba(234, 179, 8, 0.18);
                    color: #eab308;
                }
                .b-Paid {
                    background: rgba(34, 197, 94, 0.18);
                    color: #22c55e;
                }
                .b-Rejected {
                    background: rgba(239, 68, 68, 0.18);
                    color: #ef4444;
                }
            </style>
            <div class="pgw-wrap">
                <div class="pgw-card">
                    <label>Your USD Balance</label>
                    <div class="pgw-bal">$0.0000</div>
                    <form action="/prediction/withdraw" method="post">
                        <input type="hidden" name="ci_csrf_token" value="" />
                        <label>FaucetPay Email (payout sent here)</label>
                        <input type="email" name="wallet" placeholder="you@example.com" required="" />
                        <label>Amount (USD) — min 0.1000</label>
                        <input type="number" name="amount" step="any" min="0.1" placeholder="0.0000" required="" />
                        <button class="pgw-btn" type="submit">Request Withdrawal</button>
                    </form>
                    <p style="color: #8a7fb0; font-size: 12px; margin-top: 12px">
                        Paid out as USDT on FaucetPay after admin review.
                    </p>
                </div>
    
                <div class="pgw-card">
                    <h4 style="color: #fff; margin-bottom: 14px">Withdrawal History</h4>
                    <div style="overflow-x: auto">
                        <table class="pgw-tbl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Wallet</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #8a7fb0; padding: 20px">
                                        No withdrawals yet.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>