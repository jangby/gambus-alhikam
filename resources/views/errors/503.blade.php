<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>503 Service Unavailable - System Suspended</title>
    
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f1f1;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background: #fff;
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        h1 {
            font-size: 24px;
            font-weight: 500;
            margin-top: 0;
            color: #d32f2f;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
            color: #555;
        }
        .status-box {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 15px;
            margin: 20px 0;
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, monospace;
            font-size: 12px;
        }
        .footer {
            margin-top: 30px;
            font-size: 11px;
            color: #aaa;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .code {
            color: #d32f2f;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Service Suspension Notice</h1>
        
        <p>The requested resource is temporarily unavailable. The automated billing system has detected an outstanding balance or expired subscription for the following infrastructure components:</p>
        
        <div class="status-box">
            <div>> INSTANCE_STATUS: <span class="code">SUSPENDED</span></div>
            <div>> DATABASE_CLUSTER: <span class="code">LOCKED</span></div>
            <div>> STORAGE_NODE_01: <span class="code">READ_ONLY</span></div>
            <div>> SERVICE_UID: ALHKM-BCKEND-99283X</div>
        </div>

        <p>Acknowledge: Access to the dashboard and associated management tools has been restricted. Please contact your system provider or infrastructure administrator to resolve the billing status and restore full service functionality.</p>

        <div class="footer">
            Server Engine v.2.44.1 - Automated System Message
        </div>
    </div>
</body>
</html>