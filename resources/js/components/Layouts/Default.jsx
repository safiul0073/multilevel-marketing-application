import React from "react";
import { Route, Routes } from "react-router-loading";
import Category from "../../Page/Category";
import Dashboard from "../../Page/Dashboard";
import Package from "../../Page/Package";
import User from "../../Page/User/Index";
import BinaryTree from "../../Page/User/BinaryTree";
import Slider from "../../Page/Slider";
import Login from "../Auth/Login";
import Sidebar from "../Sidebar";
import Epin from "../../Page/Epin";
import Create from "../../Page/User/Create";
import Reward from "../../Page/Reward";
import Incentive from "../../Page/Bonus/Incentive";
import Generation from "../../Page/Settings/Generation";
import IncentiveReport from "../../Page/Report/Incentive";
import GenerationReport from "../../Page/Report/Generation";
import JoiningReport from "../../Page/Report/Joining";
import MatchingReport from "../../Page/Report/Matching";
import WithdrawReport from "../../Page/Report/Withdraw";
import TopEarnedReport from "../../Page/Report/TopEarned";
import TopSponsorReport from "../../Page/Report/TopSponsor";
import Matching from "../../Page/Settings/Matching";
import SingleAmountSettings from "../../Page/Settings/SingleAmount";
import OfficeSettings from "../../Page/Settings/Office";
import HomeSettings from "../../Page/Settings/Home";
import PaymentMethod from "../../Page/PaymentMethod";
import Charge from "../../Page/Report/Charge";
import PackagePurchase from "../../Page/Report/PackagePurchase";
import Transaction from "../../Page/Report/Transaction";
import RewardReport from "../../Page/Report/Reward";
import Blog from "../../Page/Blog";
import { useRedirectRoute } from "../../hooks/others";
import PrivacyPolicy from "../../Page/Settings/PrivacyPolicy";
import SpamPolicy from "../../Page/Settings/SpamPolicy";
import DisclaimerPolicy from "../../Page/Settings/DisclaimerPolicy";
import TramsCondition from "../../Page/Settings/TramsCondition";
import Gallery from "../../Page/Gallery/Index";
import GalleryDetails from "../../Page/Gallery/[id]";
import AboutUs from "../../Page/Settings/AboutUs";
import Faq from "../../Page/Faq";
import Contact from "../../Page/Contact/Index";

const Layout = () => {
    useRedirectRoute();
    return (
        <>
            <div className="min-h-full">
                <Sidebar />
                <Routes>
                    <Route path="/staff/dashboard" element={<Dashboard />} />
                    <Route path="/staff/category" element={<Category />} />
                    <Route path="/staff/slider" element={<Slider />} />
                    <Route path="/staff/faq" element={<Faq />} />
                    <Route path="/staff/gallery" element={<Gallery />} />
                    <Route
                        path="/staff/gallery/:id"
                        element={<GalleryDetails />}
                    />
                    <Route path="/staff/package" element={<Package />} />
                    <Route path="/staff/users" element={<User />} />
                    <Route
                        path="/staff/users/binary-tree"
                        element={<BinaryTree />}
                    />
                    <Route
                        path="/staff/users/registration"
                        element={<Create />}
                    />
                    <Route path="/staff/reward" element={<Reward />} />
                    <Route path="/staff/contact" element={<Contact />} />
                    <Route
                        path="/staff/payment-method"
                        element={<PaymentMethod />}
                    />
                    <Route path="/staff/blogs" element={<Blog />} />
                    <Route
                        path="/staff/bonus/incentive"
                        element={<Incentive />}
                    />
                    <Route
                        path="/staff/reports/incentive"
                        element={<IncentiveReport />}
                    />
                    <Route
                        path="/staff/reports/matching"
                        element={<MatchingReport />}
                    />
                    <Route
                        path="/staff/reports/joining"
                        element={<JoiningReport />}
                    />
                    <Route
                        path="/staff/reports/withdraw"
                        element={<WithdrawReport />}
                    />
                    <Route
                        path="/staff/reports/generation"
                        element={<GenerationReport />}
                    />
                    <Route
                        path="/staff/reports/top-earned"
                        element={<TopEarnedReport />}
                    />
                    <Route
                        path="/staff/reports/top-sponsor"
                        element={<TopSponsorReport />}
                    />
                    <Route path="/staff/reports/charges" element={<Charge />} />
                    <Route
                        path="/staff/reports/transactions"
                        element={<Transaction />}
                    />
                    <Route
                        path="/staff/reports/rewards"
                        element={<RewardReport />}
                    />
                    <Route
                        path="/staff/reports/package-purchase"
                        element={<PackagePurchase />}
                    />
                    <Route
                        path="/staff/settings/generation"
                        element={<Generation />}
                    />
                    <Route
                        path="/staff/settings/matching"
                        element={<Matching />}
                    />
                    <Route
                        path="/staff/settings/single-amount"
                        element={<SingleAmountSettings />}
                    />
                    <Route
                        path="/staff/settings/office-info"
                        element={<OfficeSettings />}
                    />
                    <Route
                        path="/staff/settings/home-content"
                        element={<HomeSettings />}
                    />
                    <Route
                        path="/staff/settings/privacy-policy"
                        element={<PrivacyPolicy />}
                    />
                    <Route
                        path="/staff/settings/spam-policy"
                        element={<SpamPolicy />}
                    />
                    <Route
                        path="/staff/settings/Disclaimer-policy"
                        element={<DisclaimerPolicy />}
                    />
                    <Route
                        path="/staff/settings/trams-and-condition"
                        element={<TramsCondition />}
                    />
                    <Route
                        path="/staff/settings/about-us"
                        element={<AboutUs />}
                    />
                    <Route path="/staff/epin" element={<Epin />} />
                    <Route path="/staff/login" element={<Login />} />
                </Routes>
            </div>
        </>
    );
};
export default Layout;
