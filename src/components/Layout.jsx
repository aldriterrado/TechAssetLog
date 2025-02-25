import { Outlet, Link } from "react-router-dom";

function Layout(){
    return(
        <div style={{display: "flex", height: "100vh"}}>
            <aside className="pt-5 bg-dark"  style={{width: "250px"}}>
                <ul>
                    <li>
                        <Link to="/TechAssetLog/dashboard">Dashboard</Link>
                    </li>
                    <li>
                        <Link to="dashboard">Hardware Asset</Link>
                    </li>
                </ul>
            </aside>
            <div className="container-fluid pt-5 ps-5 pe-5">
                <Outlet />
            </div>
        </div>
    );
}
export default Layout;