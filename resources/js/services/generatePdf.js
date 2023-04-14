import jsPDF from "jspdf";
import "jspdf-autotable";
import moment from "moment";
// Date Fns is used to format the dates we receive
// from our API call

// define a generatePDF function that accepts a tickets argument
const generatePDF = (datas, labels, headerTitle, reportName = "Report") => {
    // initialize jsPDF
    const doc = new jsPDF();

    // define the columns we want and their titles
    const tableColumn = labels.map((lab) => {
        return lab.label;
    });
    // define an empty array of rows
    const tableRows = [];

    // for each ticket pass all its data into an array
    datas.forEach((data) => {
        const ticketData = labels.map((lab) => {
            if (lab.key === "created_at" || lab.key === "updated_at") {
                return `${moment(eval("data." + lab.key)).format(
                    "MMMM DD YYYY, h:mm a"
                )} - ${moment(eval("data." + lab.key)).fromNow()}`;
            }
            return eval("data." + lab.key);
        });
        // push each tickcet's info into a row
        tableRows.push(ticketData);
    });
    const finalFileName =
        reportName + "_" + moment(new Date()).format("DD-MM-YYYY");
    // startY is basically margin-top
    doc.autoTable(tableColumn, tableRows, { startY: 20 });
    const date = Date().split(" ");
    // ticket title. and margin-top + margin-left
    doc.text(headerTitle, 14, 15);
    // we define the name of our PDF file.
    doc.save(`${finalFileName}.pdf`);
};

export default generatePDF;
