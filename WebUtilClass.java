package ca.bc.gov.fin.crownagencies.WebUtilLayer;

import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.time.Duration;
import java.util.Date;
import java.util.NoSuchElementException;
import java.util.Set;
import java.util.concurrent.TimeUnit;

import javax.imageio.ImageIO;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.OutputType;
import org.openqa.selenium.TakesScreenshot;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.edge.EdgeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.ExpectedCondition;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import com.aventstack.extentreports.ExtentReports;
import com.aventstack.extentreports.ExtentTest;
import com.aventstack.extentreports.reporter.ExtentHtmlReporter;
import com.aventstack.extentreports.reporter.configuration.Theme;
import com.google.common.io.Files;

public class WebUtilClass {

	public WebDriver driver;

	public static ExtentReports extent;
	public static ExtentTest text;

	//============ Launch Browser====================
	public WebDriver launchBrowser(String browser) {
		try {
			if(browser.equalsIgnoreCase("chrome")) {
				ChromeOptions options=new ChromeOptions();
				options.addArguments("--headless");
				options.addArguments("--no-sandbox");
				options.addArguments("--disable-dev-shm-usage");
				driver =new ChromeDriver();
				driver.manage().timeouts().implicitlyWait(10, TimeUnit.SECONDS);
				logPass(browser+" Browser is opened sucessfully.");
				driver.manage().window().maximize();

			}
			if(browser.equalsIgnoreCase("edge")) {
				driver =new EdgeDriver();
				driver.manage().timeouts().implicitlyWait(10, TimeUnit.SECONDS);
				logPass(browser+" Browser is opened sucessfully.");
			}
			if(browser.equalsIgnoreCase("inter")) {
				driver =new EdgeDriver();
				driver.manage().timeouts().implicitlyWait(10, TimeUnit.SECONDS);
				logPass(browser+" Browser is opened sucessfully.");
			}

			if(browser.equalsIgnoreCase("firfox")) {
				driver =new FirefoxDriver();
				driver.manage().timeouts().implicitlyWait(10, TimeUnit.SECONDS);
				logPass(browser+" Browser is opened sucessfully.");
			}

		}catch (Exception e) {
			logFail(browser+" Browser is not opened sucessfully.");

		}
		return driver;


	}
	//====== Open URL================
	public void openURL(String url) {
		try{
			driver.manage().window().maximize();
			driver.get(url);
			System.out.println(url+" ->opened sucessfully.");
			logPass(url+" --> URL is opened sucessfully.");
		}catch (Exception e) {
			logFail(url+" --> URL is not opened sucessfully.");
			// TODO: handle exception
		}

	}

	//======================== take screenshot ====================
	public void takeScreenshot(WebElement element, String ElementName) throws IOException {
		try {


			File screenshot = ((TakesScreenshot) driver).getScreenshotAs(OutputType.FILE);

			// Create a BufferedImage from the screenshot
			BufferedImage fullImg = ImageIO.read(screenshot);

			// Get the location and size of the element
			org.openqa.selenium.Point point = element.getLocation();
			int width = element.getSize().getWidth();
			int height = element.getSize().getHeight();

			// Crop the image to the element
			BufferedImage elementImg = fullImg.getSubimage(point.getX(), point.getY(), width, height);

			// Save the cropped image
			File outputfile = new File("C:\\Users\\vTech.App\\eclipse-workspace\\crownagencies\\screenshot"+ ElementName+".png");
			ImageIO.write(elementImg, "png", outputfile);

			System.out.println("Screenshot saved: " + outputfile.getAbsolutePath());
			logPass("Image has been taken sucessfully.");
			// text.addScreenCaptureFromPath(outputfile.getAbsolutePath());
		} catch (Exception e) {
			logFail("Image has not been taken sucessfully.");
		}

	}

	//======= get current URL===============
	public String getCurrentURL() {
		String currentURL=driver.getCurrentUrl();
		System.out.println(currentURL+" -> URL fetched sucessfully.");
		return currentURL;
	}
	//================= move to element====
	public void moveOnElement(WebElement element) {
		new Actions(driver).moveToElement(element).build().perform();;
		logPass("Hover is sucessfully.");
	}
	//================= move to element====
	public void moveAndClickElement(WebElement element) {
		new Actions(driver).moveToElement(element).click(element).build().perform();;
		logPass("Click is sucessfully.");
	}

	//============= scroll down=============
	public void scrollDown() {
		((JavascriptExecutor) driver).executeScript("window.scrollBy(0, 3000);");
		logPass("Scroll down is sucessfully.");
	}

	//  ================== favicon validation code--------------

	public void getAndValidateFavicon() throws Exception {
		WebUtilClass utl=	new WebUtilClass();
		// Navigate to the webpage
		//util.openURL(util.getCurrentURL());




		Thread.sleep(2000);


		// Locate the favicon link
		WebElement faviconElement = utl.driver.findElement(By.xpath("//link[@rel='icon' or @rel='stylesheet']"));
		String faviconUrl = faviconElement.getAttribute("href");

		// Validate the favicon URL
		if (isImageAccessible(faviconUrl)) {
			System.out.println("Favicon is accessible: " + faviconUrl);
		      logPass("Favicon is accessible: " + faviconUrl);
		} else {
			System.out.println("Favicon is not accessible: " + faviconUrl);
			logFail("Favicon is not accessible: " + faviconUrl);
		}

	}






	//====================
	//Method to check if the image is accessible
	private static boolean isImageAccessible(String imageUrl) {
		try {
			HttpURLConnection connection = (HttpURLConnection) new URL(imageUrl).openConnection();
			connection.setRequestMethod("HEAD");
			connection.connect();
			return connection.getResponseCode() == 200;
		} catch (Exception e) {
			return false;
		}
	}
	//======= click on element===============
	public void clickOnElement(WebElement element,String elementName) {
		try{
			element.click();
			logPass("Click on "+elementName+" is sucessfully.");
			System.out.println(elementName+" -> clicked sucessfully.");
		}catch (NoSuchElementException e) {
			new Actions(driver).click(element).build().perform();
			logPass("Click on "+elementName+" is sucessfully.");
			System.out.println(elementName+" -> clicked sucessfully.");
		}catch (Exception e) {
			JavascriptExecutor js = (JavascriptExecutor) driver;
			js.executeScript("arguments[0].click();", element);
			logPass("Click on "+elementName+" is sucessfully.");
			System.out.println(elementName+" -> clicked sucessfully.");
		}

	}

	//=================== get Title========================
	public String getTitle() {
		String title = null;
		try{
			title=driver.getTitle();
			System.out.println(title+" ->Title is fetched sucessfully.");
			logPass(title+" ->Title is fetched sucessfully.");

		}catch (Exception e) {
			logFail(title+" ->Title is not fetched sucessfully.");
			// TODO: handle exception
		}
		return title;

	}

	//================input value===============
	public void inputValue(WebElement element,String inputValue) {
		try{
			element.sendKeys(inputValue);
			logPass(inputValue+" is entered sucessfully.");
		}catch (Exception e) {
			JavascriptExecutor js = (JavascriptExecutor) driver;

			// Use JavaScript to set the value of the input field
			js.executeScript("arguments[0].value='"+inputValue+"';", element);
			logPass(inputValue+" is entered sucessfully.");

		}


	}
	//======================= Full page screenshot=================

	public void takeFullPageScreenshot(String pageName) {
		File file = ((TakesScreenshot) driver).getScreenshotAs(OutputType.FILE);
		File target=new File("C:\\Users\\vTech.App\\eclipse-workspace\\crownagencies\\screenshot\\"+pageName+".png");
		try {
			Files.copy(file, target);
			logPass(pageName+" page is taken screenshot properly.");
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			logFail(pageName+" page is not taken screenshot properly.");
		}
	}

	//==================== set Time and date============

	public String setDateTime() {
		return new SimpleDateFormat("MM_DD_YYYY_hh_mm_ss").format(new Date());
	}

	//======================== close all window============

	public void closeAllPage() {
		driver.quit();
		logPass("Browser is closed sucessfully.");
	}


	//===================== initialize Extent Report=================
	public static void setupReport() {
		ExtentHtmlReporter	htmlReport=new ExtentHtmlReporter("crownagencies Report.html");
		extent=new ExtentReports();
		htmlReport.config().setDocumentTitle("Automation Test Result");
		htmlReport.config().setReportName("Automation Testing CASIW-147 [Smoke Testing]");
		htmlReport.config().setTheme(Theme.DARK);
		htmlReport.config().setFilePath("C:\\Users\\vTech.App\\eclipse-workspace\\crownagencies\\result");
		extent.attachReporter(htmlReport);
	}
	//=========== Close Report===============
	public static void flushReport() {
		extent.flush();
	}

	//===============Create the test method for logging================
	public static void creatTest(String testName,String whichTestname) {
		text=extent.createTest(testName).assignCategory(whichTestname);
	}

	//=================== Log info====
	public static void logInfo(String logInfo) {
		text.info(logInfo);
	}

	//============== add screenshot======
	public static void addScreenshot(String pageName) {
		try {
			text.addScreenCaptureFromPath("C:\\Users\\vTech.App\\eclipse-workspace\\crownagencies\\screenshot\\"+pageName+".png");
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	//=================== Log pass====
	public static void logPass(String passMassage) {
		text.pass(passMassage);
	}
	//=================== Log fail====
	public static void logFail(String failMassage) {
		text.fail(failMassage);
	}

//======= handle multiple window
	public void closeChildWindow() {
		String mainWindowHandle = driver.getWindowHandle();
		try {
            Thread.sleep(2000); // This is just for demonstration; use WebDriverWait in production.
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
		 Set<String> windowHandles = driver.getWindowHandles();
		 for (String handle : windowHandles) {
	            if (!handle.equals(mainWindowHandle)) {
	                // Switch to the child window
	                driver.switchTo().window(handle);
	                
	                // Perform actions in the child window
	                // Example: Close the child window
	                driver.close();
	                
	                // Break out of the loop after closing the child window
	                break;
	            }
	            
	
		 }
		 driver.switchTo().window(mainWindowHandle);
	}
	
	//======== set the time particular element
	
	public void waitTime(String elementXpath) {
		WebDriverWait wait=	new WebDriverWait(driver, Duration.ofMillis(10000));
		wait.until(ExpectedConditions.presenceOfElementLocated(By.xpath(elementXpath)));
	}
}
