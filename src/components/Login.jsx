import 'bootstrap/dist/css/bootstrap.min.css';
import "./../styles/login.css";

function Login() {

    const getYear = () => {
        return new Date().getFullYear();
    }
    return(
        <main className='container-fluid'>
            <div className="row" style={{height: "100dvh"}}>
                <div className="col-6 bg-dark text-white d-flex flex-column justify-content-center align-items-center">
                    <h1 className='mb-5' style={{fontWeight: "700"}}>Welcome To</h1>
                    <img className='techAssetLogo mt-3' src="/techAssetLogo.png" alt="" style={{width: "100px"}} />
                    <h1 className='fw-bold mt-5'><span style={{color: "#FF5C00", fontWeight: "800"}}>TechAsset</span> Log</h1>
                    <p className='text-center text-secondary mt-5 mb-5 fs-5' style={{fontWeight: "250"}}>Manage your tech assets efficiently with our <br />comprehensive tracking system</p>
                    <small className='text-secondary mt-5'>&#169; {getYear()} Aldri Terrado. All Rights Reserved.</small>
                </div>
                <div className="col-6 d-flex flex-column justify-content-center " style={{padding: "50px 150px"}}>
                    <div className="">
                        <h1 className='text-start mb-5 fw-bold'>Login</h1>
                        <form action="">
                            <div className="position-relative user-name-div">
                                <img className='position-absolute' src="/person.svg" alt="" />
                                <input id='userName' className='form-control ps-5 pe-4 pt-3 pb-3 mb-4 shadow-none' type="text" placeholder='Username' required />
                            </div>
                            
                            <div className="position-relative password-div">
                            <img className='position-absolute' src="/password.svg" alt="" />
                                <input id='userName' className='form-control ps-5 pe-4 pt-3 pb-3 mb-4 shadow-none' type="password" placeholder='Password' required />
                            </div>
                            <button className='btn form-control btn-dark ps-4 pe-4 pt-3 pb-3'>Sign in</button>
                            
                            <p className='mt-4 text-secondary'>Server Status: <span className='text-success'>Connected</span></p>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    )
}
export default Login;