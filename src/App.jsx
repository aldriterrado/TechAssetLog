import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import Layout from './components/Layout'
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  return (
    <Router>
      <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/TechAssetLog" element={<Layout />}>
            <Route path="dashboard" element={<Dashboard />} />
          </Route>
      </Routes>
  </Router>
)
}

export default App
