import PyPDF2

# List of PDF files to merge in the correct order
pdf_files = [
    '1. Sampul.pdf',
    '2. Word.pdf', 
    '3. Excel.pdf',
    '4. AI.pdf',
    '5. Excel Pro.pdf',
    '6. Desain.pdf'
]

# Create a PDF writer object
pdf_writer = PyPDF2.PdfWriter()

# Iterate through each PDF file and add its pages to the writer
for pdf_file in pdf_files:
    with open(pdf_file, 'rb') as file:
        pdf_reader = PyPDF2.PdfReader(file)
        # Add all pages from the current PDF to the writer
        for page_num in range(len(pdf_reader.pages)):
            pdf_writer.add_page(pdf_reader.pages[page_num])

# Write the merged PDF to a new file
with open('Komputer.pdf', 'wb') as output_file:
    pdf_writer.write(output_file)

print("PDF files have been successfully merged into 'Komputer.pdf'")